<link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/chat.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/chat.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
    </script>

    <script>
        $(document).ready(function() {
            $('#action_menu_btn').click(function() {
                $('.action_menu').toggle();
            });
        });
    </script>
</head>
<!--Coded With Love By Mutiullah Samim-->

<body>

    <div class="container-fluid h-100 col-md-12">
        <div class="row justify-content-center h-100">

            {{-- Chat body --}}
            <div class="col-md-10 col-xl-9 chat">
                <div class="card">

                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="https://static.turbosquid.com/Preview/001214/650/2V/boy-cartoon-3D-model_D.jpg"
                                    class="rounded-circle user_img">
                                <span class="online_icon"></span>
                            </div>
                            <div class="user_info">
                                <span>Chat With Us</span>
                                {{-- <p>1767 Messages</p> --}}
                            </div>

                        </div>
                    </div>

                    <div class="card-body msg_card_body">

                        @if (count($conversation_messages) > 0)
                            @foreach ($conversation_messages as $message)
                                @if ($message->is_customer != 1)
                                    {{-- Left --}}
                                    <div class="d-flex justify-content-start mb-4">
                                        <div class="img_cont_msg">
                                            <img src="https://static.turbosquid.com/Preview/001214/650/2V/boy-cartoon-3D-model_D.jpg"
                                                class="rounded-circle user_img_msg">
                                        </div>
                                        <div class="msg_cotainer">
                                            {{ $message->message }}
                                            <span
                                                class="msg_time">{{ $message->sent_at->format('h:i A, d M') }}</span>

                                        </div>
                                    </div>
                                @else
                                    {{-- Right --}}
                                    <div class="d-flex justify-content-end mb-4">
                                        <div class="msg_cotainer_send">
                                            {{ $message->message }}
                                            <span
                                                class="msg_time_send">{{ $message->sent_at->format('h:i A, d M') }}</span>
                                        </div>
                                        <div class="img_cont_msg">
                                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                                class="rounded-circle user_img_msg">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <!-- إضافة الفورم -->
                    <form action="{{ Route('storeCustomerMessage') }}" method="POST">
                        @csrf
                        <div class="card-footer">
                            <div class="input-group">
                                <textarea name="message" class="form-control type_msg" placeholder="Type your message..." required></textarea> <!-- إضافة name للتعامل مع البيانات -->
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text send_btn">
                                        <!-- تغيير span إلى button ليكون زر إرسال -->
                                        <i class="fas fa-location-arrow"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div>
                <a href="{{ Route('indexPage') }}" class="back-button">Back to Home</a>
            </div>

        </div>
    </div>

</body>

</html>
