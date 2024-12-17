<style>
    #uni_modal .modal-footer, #uni_modal .modal-header {
        display: none !important;
    }
    .success-container {
        text-align: center;
        padding: 50px;
        background: linear-gradient(135deg, #e3ffe7, #d9e7ff);
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        max-width: 600px;
        margin: auto;
    }
    .success-message {
        font-size: 20px;
        color: #333;
        margin-top: 15px;
        line-height: 1.6;
    }
    .close-button-container {
        text-align: center;
        margin-top: 25px;
    }
    .text-success {
        color: #4caf50;
        font-size: 28px;
        font-weight: bold;
    }
    .btn-flat {
        background: #4caf50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .btn-flat:hover {
        background: #45a049;
    }
</style>

<div class="container-fluid success-container">
    <h4 class="text-success">Success!</h4>
    <p class="success-message">Your request has been successfully sent. Please wait for confirmation once the management reviews it. Thank you and God Bless :)</p>
    <div class="close-button-container">
        <button class="btn btn-sm btn-flat" type="button" data-dismiss="modal">Close</button>
    </div>
</div>
