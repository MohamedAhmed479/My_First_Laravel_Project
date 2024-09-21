<form action="{{ $href }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">
        <i class="fe fe-trash-2 fa-2x"></i>
    </button>
</form>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this item?');
    }
</script>