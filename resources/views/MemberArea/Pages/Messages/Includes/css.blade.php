<style>
    .chat-conversation .conversation-list {
        max-width: 65%;
    }

    .textarea:focus {
        outline: none !important;
        border: 2px solid #ced4da !important;
    }

    textarea {
        display: block;
        resize: both;
        min-height: 40px;
        line-height: 20px;
        width: 1200px;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        background-color: #eff2f7 !important;
        border-color: #ececec !important;
        padding: 10px;
        max-width: 95%;
    }

    .textarea[contenteditable]:empty::before {
        content: "Enter message";
        color: gray;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 40px;
        border-radius: 30px;
    }


    .bg-white {
        background-color: rgb(255, 255, 255);
    }

    .bg-ece {
        background-color: #e2e2e2;
    }

    .width70 {
        max-width: 70%;
    }

    .chat-conversation .read_msg .conversation-list:before {
        content: "✔✔";
        position: absolute;
        color: #5ae655;
        right: 0;
        bottom: 0;
        font-size: 15px;
    }

    .chat-conversation .un_read_msg .conversation-list:before {
        content: "✔";
        position: absolute;
        color: #5ae655;
        right: 0;
        bottom: 0;
        font-size: 15px;
    }

    .chat-conversation .right_read_msg .conversation-list:before {
        content: "✔✔";
        position: absolute;
        color: #5ae655;
        left: 0;
        bottom: 0;
        font-size: 15px;
    }

    .chat-conversation .right_un_read_msg .conversation-list:before {
        content: "✔";
        position: absolute;
        color: #5ae655;
        left: 0;
        bottom: 0;
        font-size: 15px;
    }

    @media only screen and (max-width: 540px) {
        .chat-conversation .conversation-list .ctext-wrap {
            padding: 10px 20px;
        }

        .chat-conversation .right_read_msg .conversation-list:before {
            left: -30px;
        }

        .chat-conversation .read_msg .conversation-list:before {
            right: -30px;
        }

        .chat-conversation .right_un_read_msg .conversation-list:before {
            left: -15px;
        }

        .chat-conversation .un_read_msg .conversation-list:before {
            right: -15px;
        }

        .chat-conversation .conversation-list .chat-time {
            font-size: 11px;
        }
    }

</style>
