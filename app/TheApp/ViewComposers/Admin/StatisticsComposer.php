<?php
namespace App\TheApp\ViewComposers\Admin;

use App\TheApp\Repository\Admin\Orders\OrderRepository as Order;
use App\TheApp\Repository\Admin\Users\UserRepository as User;
use Illuminate\View\View;

class StatisticsComposer
{
    public function __construct(User $user,Order $order)
    {
        $this->userStDate   = $user->userCreatedStatistics();
        $this->userStActive = $user->userActiveStatus();
        $this->users        = $user->count();
        // $this->orders       = $order->countDone();
        // $this->ordersProfit = $order->totalProfit();
        // $this->newOrders    = $order->countNewOrders();
        // $this->orderChart   = $order->monthlyProfite();
        // $this->orderStatus  = $order->ordersType();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('allUsers'      , $this->users);
        $view->with('userStDate'    , $this->userStDate);
        $view->with('userStActive'  , $this->userStActive);
        // $view->with('allOrders'     , $this->orders);
        // $view->with('allProfit'     , $this->ordersProfit);
        // $view->with('newOrders'     , $this->newOrders);
        // $view->with('orderChart'    , $this->orderChart);
        // $view->with('orderStatus'   , $this->orderStatus);
    }
}
