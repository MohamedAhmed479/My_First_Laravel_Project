<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f06, #4a90e2);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #order-details {
            padding: 20px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2em;
            margin: 5px 0;
        }

        .download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .download-btn:hover {
            background-color: #357abd;
        }

        .back-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    @php
        $delivery_time =
            $order->delivery_time == null ? 'To be determined later' : $order->delivery_time->format('d M Y');
    @endphp

    <div id="order-details">
        <h2>Order Details</h2>
        <p>Order ID: {{ $order->id }}</p>
        <p>Delivery time: {{ $delivery_time }}</p>
        <p>Delivery to: {{ $customer->address }}</p>
        <p>Total: ${{ $order->net_total }}</p>

        <h3>Customer Information:</h3>
        <p>Name: {{ $customer->username }}</p>
        <p>Address: {{ $customer->address }}</p>
        <p>Email: {{ $customer->email }}</p>
        <p>Phone:{{ $customer->phone }}</p>

        <button class="download-btn" onclick="downloadPDF()">Download as PDF</button>
        <button class="back-btn" onclick="goToIndex()">Back to Home</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        function downloadPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.setFontSize(25);
            doc.setTextColor("#4a90e2");
            doc.text("Order Details", 105, 30, null, null, "center");

            doc.setDrawColor(0);
            doc.setFillColor(255, 255, 255);
            doc.rect(10, 40, 190, 150, 'FD');

            doc.setFontSize(16);
            doc.setTextColor(0);
            doc.text("Order ID: {{ $order->id }}", 20, 60);
            doc.text("Delivery time: {{ $delivery_time }}", 20, 70);
            doc.text("Delivery to: {{ $customer->address }}", 20, 80);
            doc.text("Total: ${{ $order->net_total }}", 20, 90);

            doc.text("Customer Information:", 20, 120);
            doc.text("Name: {{ $customer->username }}", 30, 135);
            doc.text("Address: {{ $customer->address }}", 30, 150);
            doc.text("Email: {{ $customer->email }}", 30, 165);
            doc.text("Phone: {{ $customer->phone }}", 30, 180);

            doc.setDrawColor(0);
            doc.setFillColor("#4a90e2");
            doc.rect(0, 280, 210, 20, 'FD');

            doc.setTextColor(255);
            doc.text("Thank you for your purchase!", 105, 290, null, null, "center");

            doc.save("order-details.pdf");
        }

        function goToIndex() {
            window.location.href = "/";
        }
    </script>

</body>

</html>
