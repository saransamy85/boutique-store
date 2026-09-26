<x-mail::message>
    # Order Confirmation - Kathirazhagi boutique

    Hi {{ $order->customer_name }},

    Thank you for your order! We have received your order and are currently processing it.

    **Order Details:**
    - **Order Number:** {{ $order->order_number }}
    - **Payment Method:** {{ strtoupper($order->payment_method) }}
    - **Payment Status:** {{ ucfirst($order->payment_status) }}
    - **Total Amount:** {{ number_format($order->total_amount, 2) }}

    **Shipping Address:**
    {{ $order->address }}<br>
    {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}<br>
    Phone: {{ $order->phone }}

    ## Items Ordered

    <x-mail::table>
        | Product | Price | Qty | Total |
        |:--------|:------|:----|:------|
        @foreach($order->items as $item)
        | {{ $item->product_name }} | {{ number_format($item->price, 2) }} | {{ $item->quantity }} | {{ number_format($item->total, 2) }} |
        @endforeach
    </x-mail::table>

    **Subtotal:** {{ number_format($order->subtotal, 2) }}<br>
    **Shipping:** {{ number_format($order->shipping_charge, 2) }}<br>
    **Grand Total:** {{ number_format($order->total_amount, 2) }}

    Thanks,<br>
    Kathirazhagi Boutique
</x-mail::message>
