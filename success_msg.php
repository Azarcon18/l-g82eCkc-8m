<style>
    #uni_modal .modal-footer, #uni_modal .modal-header {
        display: none !important;
    }
    .success-container {
        text-align: center;
        padding: 40px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: auto;
    }
    .success-message {
        font-size: 18px;
        color: #555;
        margin-top: 10px;
    }
    .close-button-container {
        text-align: center;
        margin-top: 20px;
    }
    .text-success {
        color: #28a745;
        font-size: 24px;
        font-weight: bold;
    }
    .btn-flat {
        background: #e7e7e7;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }
    .btn-flat:hover {
        background:rgb(0, 124, 225);
    }
</style>

<div class="container-fluid success-container">
    <h4 class="text-success">Success!</h4>
    <p class="success-message">Your request has been successfully sent. Please wait for confirmation once the management reviews it. Thank you and God Bless :)</p>
    <div class="close-button-container">
        <button class="btn btn-sm btn-flat" type="button" data-dismiss="modal">Close</button>
    </div>
</div>
