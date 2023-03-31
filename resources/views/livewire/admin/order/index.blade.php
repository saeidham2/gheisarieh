@section('title','سفارشات')
<div>
    <div class="main-content" wire:init="loadCategory">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="/admin/orders">سفارشات</a>

                <a class="tab__item " href="/admin/orders/wait"> در انتظار </a>
                <a class="tab__item " href="/admin/orders/progress"> در حال پردازش</a>
                <a class="tab__item " href="/admin/orders/complete"> تکمیل شده</a>
                <a class="tab__item " href="/admin/orders/returned"> مرجوعی</a>
                <a class="tab__item " href="/admin/orders/cancel"> لغو شده</a>


                |
                {{--                <a class="tab__item">جستجو: </a>--}}

                <a class="t-header-search">
                    <form action="" onclick="event.preventDefault();">
                        <input wire:model.debounce.1000="search"
                               type="text" class="text" placeholder="جستجوی سفارش ...">
                    </form>
                </a>

            </div>
        </div>
        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>آیدی سفارش</th>
                            <th>شماره سفارش</th>
                            <th>کاربر سفارش دهنده</th>
                            <th>پرداخت</th>
                            <th>وضعیت سفارش</th>
                            <th>شیوه ارسال</th>
                            <th>تاریخ ثبت سفارش</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        @if($readyToLoad)
                            <tbody>
                            @foreach($orders as $order)
                                <tr role="row">
                                    <td><a href="">{{$order->id}}</a></td>
                                    <td><a href="">{{$order->order_number}}</a></td>
                                    <td><a href="">{{$order->user->name}}</a></td>
                                    <td>
                                        @if($order->payment ==1)
                                            <span class="alert alert-success">پرداخت شده</span>
                                        @else
                                            در انتظار پرداخت
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status =='wait')
                                            <span class="alert alert-warning">در انتظار پرداخت</span>
                                        @elseif ($order->status =='delivered')
                                            <span class="alert alert-success">تحویل داده شده</span>
                                        @elseif ($order->status =='returned')
                                            <span class="alert alert-danger">مرجوعی</span>
                                        @elseif ($order->status =='paid')
                                            <span class="alert alert-primary">پرداخت شده</span>
                                        @elseif ($order->status =='progress')
                                            <span class="alert alert-dark">در حال آماده سازی سفارش</span>
                                        @elseif ($order->status =='sended')
                                            <span class="alert alert-info">در حال ارسال سفارش</span>
                                        @elseif ($order->status =='cancel')
                                            <span class="alert alert-danger">لغو شده</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->type_send ==1)
                                            <span class="alert alert-success">انبار</span>
                                        @else
                                           ارسال
                                        @endif
                                    </td>
                                    <td>{{\App\Models\PersianNumber::translate(jdate($order->created_at)->format(' %d %B %Y'))}}</td>

                                    <td>

                                        <a href="{{route('admin.orders.indexupdate',$order)}}" class="item-edit mlg-15"
                                           title="ویرایش"></a>
                                        <br>
                                        <a href="{{route('admin.orders.showOrder',$order)}}" style="margin-left: 10px;"
                                           class=" "
                                           title="نمایش سفارش">
                                            <img width: 20px; src="{{asset('icons/icons/sun.svg')}}"
                                                 alt="images">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            {{$orders->render()}}
                        @else



                            <div class="alert-warning alert">
                                در حال خواندن اطلاعات از دیتابیس ...
                            </div>


                        @endif


                    </table>
                </div>


            </div>
        </div>


    </div>

</div>
