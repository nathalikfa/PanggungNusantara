<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Payment - Panggung Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<body class="bg-gradient-to-br from-purple-700 via-pink-500 to-purple-600 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl flex flex-col md:flex-row">
        <!-- Left Section: Success Message -->
        <div class="bg-[#4B0082] text-white p-8 md:w-1/2 flex flex-col items-center justify-center">
            <img src="/img/checked.png" alt="Success" class="w-24 h-24 mb-6">
            <h1 class="text-3xl font-bold mb-4">Ticket Purchased Successfully!</h1>
            <p class="text-lg text-left mb-6">Your ticket has been successfully purchased. Thank you for your trust!</p>
            <button onclick="window.location.href='/'" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-bold hover:bg-gray-100 transition">
                Back to Home
            </button>
        </div>

        <!-- Right Section: Ticket Information -->
        <div class="p-8 md:w-1/2 flex flex-col">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Ticket Details</h2>

            <!-- Artist Information -->
            @if ($artist)
            <div class="flex items-center mb-6">
                <img src="{{ $artist->image }}" alt="{{ $artist->name }}" class="w-24 h-24 rounded-lg object-cover shadow-md mr-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $artist->name }}</h3>
                    <p class="text-gray-600">{{ $concert->name }}</p>
                    <p class="text-gray-600">{{ \Carbon\Carbon::parse($concert->date)->format('M d • l • Y') }}</p>
                    <p class="text-gray-600">{{ $concert->location }}</p>
                </div>
            </div>
            @else
            <p class="text-gray-600">Artist information is not available.</p>
            @endif

            <!-- Ticket Details -->
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-800">Seat:</span>
                    <span class="text-gray-600 font-semibold">{{ $payment->seat_type }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-800">Number of Tickets:</span>
                    <span class="text-gray-600 font-semibold">{{ $payment->quantity }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-800">Total Price:</span>
                    <span class="text-pink-500 font-bold">Rp. {{ number_format($payment->price, 2, ',', '.') }}</span>
                </div>
            </div>

            <!-- Ticket Code -->
            <div class="mt-6 bg-gray-100 p-4 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <p class="text-gray-800 font-bold text-lg">Ticket Code:</p>
                    <p id="ticketCode" class="text-purple-600 font-semibold text-lg mt-2">{{ $payment->ticket_code }}</p>
                </div>
                <button onclick="downloadPDF()" class="bg-pink-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-pink-600">
                    Download
                </button>
            </div>
        </div>
    </div>

    <script>
        // Download Ticket Code as PDF
        async function downloadPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            const ticketCodeText = "{{ $payment->id }}"; // Ticket Code from backend

            // Add content to the PDF
            doc.setFontSize(22);
            doc.setTextColor(40, 40, 40);
            doc.text('Ticket Code', 105, 30, {
                align: 'center'
            });
            doc.setFontSize(18);
            doc.setTextColor(128, 0, 128);
            doc.text(ticketCodeText, 105, 50, {
                align: 'center'
            });

            doc.setFontSize(14);
            doc.setTextColor(40, 40, 40);
            doc.text('Thank you for your purchase!', 105, 70, {
                align: 'center'
            });

            // Save the PDF
            doc.save(`Ticket_${ticketCodeText}.pdf`);
        }
    </script>
</body>

</html>