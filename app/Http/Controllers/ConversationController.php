<?php

namespace App\Http\Controllers;

use App\Models\conversation;
use App\Http\Requests\StoreconversationRequest;
use App\Http\Requests\UpdateconversationRequest;
use App\Models\User;
use App\Policies\ConversationPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($__conversation_id__ = null)
    {
        $customers_conversations = [];

        // استرجاع المحادثات وترتيبها بناءً على أحدث رسالة
        $conversations_id = Conversation::select('conversation_id', DB::raw('MAX(sent_at) as last_message'))
            ->groupBy('conversation_id')
            ->orderBy('last_message', 'desc') // ترتيب حسب آخر رسالة
            ->get();

        // جلب العملاء بناءً على المحادثات
        foreach ($conversations_id as $conversation) {
            $customer = User::where('id', $conversation->conversation_id)
                ->where('rule', 'customer')
                ->first();

            if ($customer) {
                $customers_conversations[] = $customer;
            }
        }

        // التحقق من محادثة محددة بناءً على $__conversation_id__
        if ($__conversation_id__ != null) {
            // استرجاع الرسائل للمحادثة المطلوبة وترتيبها
            $conversation_messages = Conversation::where('conversation_id', $__conversation_id__)
                ->orderBy('sent_at', 'asc')
                ->get();

            // إذا لم تكن هناك رسائل، العودة للخلف
            if (count($conversation_messages) <= 0) {
                return back();
            }

            // جلب معلومات العميل للمحادثة المحددة
            $customer = User::find($__conversation_id__);
            $username_customer = $customer->username;
            $id_customer = $customer->id;
        } else {
            $id_customer = null;
            $conversation_messages = null;
        }

        return view('admin.chats.chat', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreconversationRequest $request)
    {
        $message_info = $request->validated();

        conversation::create([
            'conversation_id' => $message_info['conversation_id'],
            'sender_id' => Auth::user()->id, // Authenticated user ID
            'receiver_id' => $message_info['conversation_id'], // Authenticated user ID
            'message' => $message_info['message'],
            'status' => 'sent',
            'is_customer' => 0, // Assuming there is a column in the users table

        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateconversationRequest $request, conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($conversation_id)
    {
        $conversation_messages = Conversation::where('conversation_id', $conversation_id)->get();
        if (count($conversation_messages) > 0) {
            foreach ($conversation_messages as $message) {
                $message->delete();
            }
        }
        return to_route('admin.conversations.index');
    }

    public function viewProfile($customer_id)
    {

        $customer = User::find($customer_id);

        if (! $customer) {
            return back();
        }

        return view('customers.view_specific_customer', get_defined_vars());
    }
}
