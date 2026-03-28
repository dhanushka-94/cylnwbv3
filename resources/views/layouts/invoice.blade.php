<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Invoice - Ceylon IT Solutions')</title>
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Print Styles -->
    <style>
        /* Base styles for invoice */
        body {
            background: white !important;
            color: #1f2937 !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        /* Print-specific styles */
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                background: white !important;
                color: #1f2937 !important;
            }
            
            .no-print {
                display: none !important;
            }
            
            .print-break-before {
                page-break-before: always;
            }
            
            .print-break-after {
                page-break-after: always;
            }
            
            .print-break-inside-avoid {
                page-break-inside: avoid;
            }
            
            /* Ensure gradients print correctly */
            .bg-gradient-to-r {
                background: #f59e0b !important;
                background-image: none !important;
            }
            
            /* Force table borders to show */
            table, th, td {
                border: 1px solid #d1d5db !important;
            }
            
            /* Ensure all text is black */
            * {
                color: #1f2937 !important;
            }
            
            .text-white {
                color: white !important;
            }
            
            .text-orange-100 {
                color: #fed7aa !important;
            }
        }
        
        /* Screen styles - ensure readability */
        @media screen {
            body {
                background: #f9fafb;
                min-height: 100vh;
                padding: 2rem 0;
            }
            
            .invoice-container {
                max-width: 8.5in;
                margin: 0 auto;
                background: white;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        @yield('content')
    </div>

    <!-- JavaScript for PDF functionality -->
    <script>
        // Enhanced print function
        function printInvoice() {
            window.print();
        }
        
        // Auto-focus print when opened in new tab
        document.addEventListener('DOMContentLoaded', function() {
            // Check if opened in new tab for invoice
            if (window.location.pathname.includes('/invoice')) {
                // Add print button listener
                const printButton = document.querySelector('[onclick*="print"]');
                if (printButton) {
                    printButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        printInvoice();
                    });
                }
            }
        });
    </script>
</body>
</html>
