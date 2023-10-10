<head>
    <style>
        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .modal-content {
            background-color: #ffffff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 40px; /* Increased padding */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 5px;
            width: 70%; /* Increased width */
            height: auto;
            max-width: 800px;
            max-height: 90%;
            overflow: auto;
        }

        .modal-content textarea {
            height: 100px; 
        }
    </style>
</head>