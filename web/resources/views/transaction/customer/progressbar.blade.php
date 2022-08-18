<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="progress-indicator m-4">
                    <li
                        class="{{ Route::currentRouteName() == 'customer.booking' ? 'completed' : '' }} {{ Route::currentRouteName() == 'customer.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'customer.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'customer.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> How many person?
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'customer.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'customer.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'customer.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Pick a room
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'customer.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'customer.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Confirmation
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
