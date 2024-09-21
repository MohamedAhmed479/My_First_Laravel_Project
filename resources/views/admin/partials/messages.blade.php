<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- تم تغيير modal-sm إلى modal-lg -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Admins Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @php
                use App\Models\Message;
                $unread_messages = Message::where('status', 'unread')->orderBy('created_at', 'desc')->take(6)->get();
            @endphp
            <div class="modal-body">
                <div class="list-group list-group-flush my-n3">


                    @if (count($unread_messages) > 0)

                        @foreach ($unread_messages as $message)
                            <!-- الرسالة -->
                            <a href="{{ Route('admin.showMessage', ['message' => $message]) }}"
                                class="list-group-item bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="fe fe-mail fe-24"></span>
                                    </div>
                                    <div class="col">
                                        <small><strong>{{ $message->name }}</strong></small>
                                        <div class="my-0 text-muted small">
                                            {{ Str::substr($message->message, 0, 20) . '...' }}</div>
                                        <small
                                            class="badge badge-pill badge-light text-red">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="alert alert-danger" role="alert"> You have no unread messages. </div>
                    @endif

                    <!-- ... -->
                </div> <!-- / .list-group -->
            </div>
            @if (count($unread_messages) > 0)
                {{-- See All --}}
                <a href="{{ Route('admin.unReadMessages') }}" class="list-group-item bg-transparent">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="fe fe-mail fe-24"></span>
                        </div>
                        <div class="col">
                            <small><strong>See all unread messages</strong></small>
                        </div>
                    </div>
                </a>
            @endif

        </div>

    </div>
</div>
