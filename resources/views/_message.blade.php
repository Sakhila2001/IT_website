@if(!empty(session('success')))
    <div class="alert alert-success" role="alert" id="success-message">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger" role="alert" id="error-message">
        {{ session('error') }}
    </div>
@endif

@if(!empty(session('payment-error')))
    <div class="alert alert-error" role="alert" id="payment-error-message">
        {{session('payment-error') }}
    </div>
@endif

@if(!empty(session('warning')))
    <div class="alert alert-warning" role="alert" id="warning-message">
        {{session('warning') }}
    </div>
@endif

@if(!empty(session('info')))
    <div class="alert alert-info" role="alert" id="info-message">
        {{ session('info') }}
    </div>
@endif

@if(!empty(session('secondary')))
    <div class="alert alert-secondary" role="alert" id="secondary-message">
        {{session('secondary') }}
    </div>
@endif

@if(!empty(session('primary')))
    <div class="alert alert-primary" role="alert" id="primary-message">
        {{ session('primary') }}
    </div>
@endif

@if(!empty(session('light')))
    <div class="alert alert-light" role="alert" id="light-message">
        {{ session('light')}}
    </div>
@endif

{{-- Add custom CSS and JS --}}

<style>
    /* Make the alert box compact and reduce the space it takes */
    .alert {
        padding: 15px 25px;
        font-size: 14px;
        margin: 0 15px 15px 0;
        border-radius: 5px;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
        position: absolute;
        top: -60px; /* Increased top value to make the message pop up higher */
        right: 15px;
        width: auto;  /* Let the width be auto */
        max-width: 350px; /* Limit the max width to 250px */
        z-index: 9999;
    }

    /* Make the success message light pink */
    .alert-success {
        background-color: #7BD679;  /* Light green background */
        border-color: #7BD679;  /* Light pink border */
        color: #fff;  /* Dark text for contrast */
    }

    /* Add fade-out effect */
    .alert.fade-out {
        opacity: 0;
    }
</style>

<script>
    // Auto-hide success, error, and other messages after 3 seconds
    setTimeout(function() {
        // Select all alert elements by their ids
        const messageIds = [
            'success-message',
            'error-message',
            'payment-error-message',
            'warning-message',
            'info-message',
            'secondary-message',
            'primary-message',
            'light-message'
        ];

        // Add fade-out class to each message
        messageIds.forEach(function(messageId) {
            var message = document.getElementById(messageId);
            if (message) {
                message.classList.add('fade-out');
            }
        });
    }, 5000); // 3000 milliseconds = 3 seconds
</script>