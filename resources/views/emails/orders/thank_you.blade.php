<x-mail::message>
    # Thank You for Your Order!

    Hi {{ $order->customer_name }},

    Thank you so much for shopping at Kathirazhagi boutique. We have successfully received your order ({{ $order->order_number }}) and are working on getting it dispatched to you soon!

    We will notify you once your order has been dispatched.

    Thanks again,<br>
    Kathirazhagi boutique
</x-mail::message>
