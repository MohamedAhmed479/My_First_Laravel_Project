@if (session($key))
<div class="alert alert-success">{{ session($key) }}</div>
@endif