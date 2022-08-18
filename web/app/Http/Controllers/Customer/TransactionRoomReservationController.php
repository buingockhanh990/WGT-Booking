<?php

namespace App\Http\Controllers\Customer;

use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Helpers\Helper;
use App\Http\Requests\ChooseRoomRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewRoomReservationDownPayment;
use App\Repositories\CustomerRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionRoomReservationController extends Controller
{
    private $reservationRepository;

    private function getCustomer(){
        $idCustomer = Auth::user()->id;
        return  Customer::where('user_id',$idCustomer)->first();
    }

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function pickFromCustomer(Request $request, CustomerRepository $customerRepository)
    {
        $customers = $customerRepository->get($request);
        $customersCount = $customerRepository->count($request);

        return view('transaction.customer.pickFromCustomer', compact('customers', 'customersCount'));
    }

    public function createIdentity()
    {
        return view('transaction.customer.createIdentity');
    }

    public function storeCustomer(StoreCustomerRequest $request, CustomerRepository $customerRepository)
    {
        $customer = $customerRepository->store($request);
        return redirect()->route('transaction.customer.viewCountPerson', ['customer' => $customer->id])->with('success', 'Customer ' . $customer->name . ' created!');
    }

    public function booking()
    {
        $customer = $this->getCustomer();
        return view('transaction.customer.viewCountPerson', compact('customer'));
    }

    public function chooseRoom(ChooseRoomRequest $request)
    {
        $customer = $this->getCustomer();
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);

        $rooms = $this->reservationRepository->getUnocuppiedroom($request, $occupiedRoomId);
        $roomsCount = $this->reservationRepository->countUnocuppiedroom($request, $occupiedRoomId);

        return view('transaction.customer.chooseRoom', compact('customer', 'rooms', 'stayFrom', 'stayUntil', 'roomsCount'));
    }

    public function confirmation(Room $room, $stayFrom, $stayUntil)
    {
        $customer = $this->getCustomer();
        $price = $room->price;
        $dayDifference = Helper::getDateDifference($stayFrom, $stayUntil);
        $downPayment = ($price * $dayDifference) * 0.15;
        return view('transaction.customer.confirmation', compact('customer', 'room', 'stayFrom', 'stayUntil', 'downPayment', 'dayDifference'));
    }

    public function payDownPayment(Room $room, Request $request, TransactionRepository $transactionRepository, PaymentRepository $paymentRepository)
    {
        $customer = $this->getCustomer();
        $dayDifference = Helper::getDateDifference($request->check_in, $request->check_out);
        $minimumDownPayment = ($room->price * $dayDifference) * 0.15;

        $request->validate([
            'downPayment' => 'required|numeric|gte:' . $minimumDownPayment
        ]);

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);
        $occupiedRoomIdInArray = $occupiedRoomId->toArray();

        if (in_array($room->id, $occupiedRoomIdInArray)) {
            return redirect()->back()->with('failed', 'Sorry, room ' . $room->number . ' already occupied');
        }

        $transaction = $transactionRepository->store($request, $customer, $room);
        $status = 'Down Payment';
        $payment = $paymentRepository->store($request, $transaction, $status);

        $superAdmins = User::where('role', 'Super')->get();

        foreach ($superAdmins as $superAdmin) {
            $message = 'Reservation added by ' . $customer->name;
            event(new NewReservationEvent($message, $superAdmin));
            $superAdmin->notify(new NewRoomReservationDownPayment($transaction, $payment));
        }

        event(new RefreshDashboardEvent("Someone reserved a room"));

        return redirect()->route('transaction.index')->with('success', 'Room ' . $room->number . ' has been reservated by ' . $customer->name);
    }

    private function getOccupiedRoomID($stayFrom, $stayUntil)
    {
        $occupiedRoomId = Transaction::where([['check_in', '<=', $stayFrom], ['check_out', '>=', $stayUntil]])
            ->orWhere([['check_in', '>=', $stayFrom], ['check_in', '<=', $stayUntil]])
            ->orWhere([['check_out', '>=', $stayFrom], ['check_out', '<=', $stayUntil]])
            ->pluck('room_id');
        return $occupiedRoomId;
    }
}
