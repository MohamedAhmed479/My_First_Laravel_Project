<link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/chat.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<html>
@php
    use Carbon\Carbon;

    use App\Models\conversation;

@endphp

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

            {{-- All contact --}}
            <div class="col-md-8 col-xl-3 chat">

                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." name="" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>

                    {{-- other contact --}}
                    <div class="card-body contacts_body">
                        <ui class="contacts">

                            {{-- contact 1 --}}
                            @if (count($customers_conversations) > 0)
                                @foreach ($customers_conversations as $customer)
                                    @php
                                        $unread_message_count = Conversation::where('conversation_id', $customer->id)
                                            ->where('status', 'sent')
                                            ->where('is_customer', 1)
                                            ->count();
                                    @endphp
                                    @php
                                        if ($customer->last_activity >= Carbon::now()->subMinutes(30)) {
                                            $customer_online = 'active';
                                            $online_icon = 'online_icon';
                                        } else {
                                            $customer_online = false;
                                            $online_icon = false;
                                        }

                                    @endphp

                                    @php
                                        if (!isset($id_customer)) {
                                            $id_customer == null;
                                        }
                                    @endphp
                                    <li class="{{ $id_customer == $customer->id ? 'active' : '' }}">
                                        {{-- active if i open his chat --}}
                                        <a href="{{ route('admin.conversations.index', ['conversation_id' => $customer->id]) }}"
                                            class="text-decoration-none">
                                            <div class="d-flex bd-highlight">
                                                <div class="img_cont">
                                                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                                        class="rounded-circle user_img">
                                                    <span
                                                        class="{{ $online_icon == 'online_icon' ? $online_icon : '' }}"></span>
                                                </div>
                                                <div class="user_info">
                                                    <span>{{ $customer->username }}</span>

                                                    @if ($customer_online == 'active')
                                                        <p>{{ $customer->username }} is online</p>
                                                    @else
                                                        <p>{{ $customer->last_activity->diffForHumans() }}</p>
                                                    @endif
                                                    @if ($unread_message_count > 0)
                                                        <p style="color: rgb(202, 239, 19);">{{ $unread_message_count }}
                                                            Unread
                                                            Message</p>
                                                    @else
                                                        <p>No Unread Messages</p>
                                                    @endif

                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                        </ui>
                    </div>
                    <div class="card-footer"></div>
                </div>

            </div>

            @if ($conversation_messages != null)

                {{-- Chat body --}}
                <div class="col-md-10 col-xl-9 chat">
                    <div class="card">
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                        class="rounded-circle user_img">
                                    <span class="{{ $online_icon == 'online_icon' ? $online_icon : '' }}"></span>
                                </div>
                                <div class="user_info">
                                    <span>Chat with {{ $username_customer }}</span>
                                    <p>His ID is {{ $id_customer }}</p>
                                </div>

                                {{-- ====================================== --}}
                                {{-- destroy conversation and view profile --}}
                                <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                                <div class="action_menu">
                                    <ul>
                                        <li id="viewProfileBtn"><i class="fas fa-user-circle"></i> View Profile</li>

                                        <li>
                                            <form id="removeConversationForm"
                                                action="{{ Route('admin.conversations.destroy', ['conversation' => $id_customer]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                            <span id="removeConversationBtn"><i class="fas fa-trash"></i> Remove
                                                Conversation</span>
                                        </li>
                                    </ul>
                                </div>

                                <script>
                                    // الانتقال إلى صفحة عرض الملف الشخصي عند النقر على زر View Profile
                                    document.getElementById("viewProfileBtn").addEventListener("click", function() {
                                        window.location.href =
                                            "{{ Route('admin.conversations.viewProfile', ['customer_id' => $id_customer]) }}";
                                    });

                                    // تقديم الفورم لإزالة المحادثة عند النقر على زر Remove Conversation
                                    document.getElementById("removeConversationBtn").addEventListener("click", function() {
                                        document.getElementById("removeConversationForm").submit();
                                    });
                                </script>

                                {{-- ====================================== --}}
                            </div>
                        </div>
                        <div class="card-body msg_card_body">
                            @if (count($conversation_messages) > 0)
                                @foreach ($conversation_messages as $message)
                                    @if ($message->is_customer == 1)
                                        {{-- Left --}}
                                        <div class="d-flex justify-content-start mb-4">
                                            <div class="img_cont_msg">
                                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
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
                                                <img src="https://static.turbosquid.com/Preview/001214/650/2V/boy-cartoon-3D-model_D.jpg"
                                                    class="rounded-circle user_img_msg">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @php
                                    Conversation::where('conversation_id', $conversation_messages[0]->conversation_id)
                                        ->where('is_customer', 1)
                                        ->update(['status' => 'read']);
                                @endphp
                            @endif
                        </div>


                        <!-- إضافة الفورم -->
                        <form action="{{ Route('admin.conversations.store') }}" method="POST">
                            @csrf
                            <div class="card-footer">
                                <div class="input-group">

                                    <input type="hidden" name="conversation_id" value="{{ $__conversation_id__ }}">

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
            @else
                <div class="col-md-10 col-xl-8 chat">
                </div>
            @endif

            <a href="{{ Route('admin.index') }}" class="back-button">Back to Dashboard</a>
        </div>
    </div>

</body>

</html>
