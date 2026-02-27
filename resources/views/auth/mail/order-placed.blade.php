<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body style="margin:0; padding:0; background-color:#f5f5f5; font-family: Arial, sans-serif; color: #333333;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f5f5f5; padding: 32px 0;">
    <tr>
        <td align="center">

            <!-- Card -->
            <table width="560" cellpadding="0" cellspacing="0" border="0" style="max-width:560px; width:100%; background-color:#ffffff; border-radius:6px; overflow:hidden;">

                <!-- Header -->
                <tr>
                    <td align="center" style="background-color:#111111; padding: 32px 40px;">
                        <p style="margin:0; font-size:22px; color:#ffffff; font-weight:bold;">{{ config('app.name') }}</p>
                        <p style="margin:10px 0 0; font-size:13px; color:#aaaaaa; letter-spacing:2px; text-transform:uppercase;">Order Placed</p>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding: 32px 40px;">

                        {{-- <p style="margin:0 0 20px; font-size:15px;">Hi <strong>{{ $order->first_name }} {{ $order->last_name }}</strong>,</p> --}}
                        <p style="margin:0 0 28px; font-size:15px; line-height:1.6; color:#555555;">
                            Thank you for your order! We've received it and it's being processed. You'll be paying via <strong>Cash on Delivery</strong>.
                        </p> 

                        <!-- Order Meta -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e5e5e5; border-radius:4px; margin-bottom:28px;">
                            <tr>
                                <td style="padding:12px 16px; font-size:13px; color:#777777; border-bottom:1px solid #e5e5e5;">Order Number</td>
                                <td align="right" style="padding:12px 16px; font-size:13px; font-weight:bold; color:#111111; border-bottom:1px solid #e5e5e5;">#{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <td style="padding:12px 16px; font-size:13px; color:#777777; border-bottom:1px solid #e5e5e5;">Order Date</td>
                                <td align="right" style="padding:12px 16px; font-size:13px; color:#111111; border-bottom:1px solid #e5e5e5;">{{ $order->created_at->format('F d, Y') }}</td>
                            </tr>
                            <tr>
                                <td style="padding:12px 16px; font-size:13px; color:#777777;">Payment</td>
                                <td align="right" style="padding:12px 16px; font-size:13px; color:#111111;">Cash on Delivery</td>
                            </tr>
                        </table>

                        <!-- Items Table -->
                        <p style="margin:0 0 12px; font-size:13px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; color:#111111;">Order Details</p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr style="background-color:#f5f5f5;">
                                <td style="padding:10px 12px; font-size:12px; color:#777777; text-transform:uppercase; letter-spacing:1px; border-top:1px solid #e5e5e5; border-bottom:1px solid #e5e5e5;">Product</td>
                                <td align="center" style="padding:10px 12px; font-size:12px; color:#777777; text-transform:uppercase; letter-spacing:1px; border-top:1px solid #e5e5e5; border-bottom:1px solid #e5e5e5;">Qty</td>
                                <td align="right" style="padding:10px 12px; font-size:12px; color:#777777; text-transform:uppercase; letter-spacing:1px; border-top:1px solid #e5e5e5; border-bottom:1px solid #e5e5e5;">Subtotal</td>
                            </tr>

                            @foreach($order->items as $item)
                            <tr>
                                <td style="padding:12px; font-size:14px; color:#333333; border-bottom:1px solid #f0f0f0;">{{ $item->product->name }}</td>
                                <td align="center" style="padding:12px; font-size:14px; color:#555555; border-bottom:1px solid #f0f0f0;">{{ $item->quntity }}</td>
                                <td align="right" style="padding:12px; font-size:14px; color:#333333; border-bottom:1px solid #f0f0f0;">${{ number_format($item->price * $item->quntity, 2) }}</td>
                            </tr>
                            @endforeach

                            <!-- Total -->
                            <tr style="background-color:#f9f9f9;">
                                <td colspan="2" style="padding:14px 12px; font-size:14px; font-weight:bold; color:#111111;">Total</td>
                                <td align="right" style="padding:14px 12px; font-size:16px; font-weight:bold; color:#111111;">${{ number_format($order->total_price, 2) }}</td>
                            </tr>
                        </table>

                        <!-- Billing Address -->
                        <p style="margin:0 0 12px; font-size:13px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; color:#111111;">Billing Address</p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e5e5e5; border-radius:4px; margin-bottom:28px;">
                            <tr>
                                <td style="padding:16px; font-size:14px; color:#555555; line-height:1.8;">
                                    <strong style="color:#111111;">{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                                    {{ $order->address }}<br>
                                    {{ $order->city }} – {{ $order->zip }}<br>
                                    {{ $order->state }}, {{ $order->country }}<br>
                                    @if($order->phone)
                                    Phone: {{ $order->phone }}<br>
                                    @endif
                                    Email: {{ $order->email }}
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0; font-size:14px; color:#555555; line-height:1.6;">
                            If you have any questions, just reply to this email.<br>
                            <span style="color:#111111; font-weight:bold;">— Team {{ config('app.name') }}</span>
                        </p> 

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>