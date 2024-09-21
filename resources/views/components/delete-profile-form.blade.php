            {{-- Where admin can delete thire profile --}}
            <div class="text-left">
                <form action="{{ Route('profile.destroy') }}" method="POST"
                    style="display: flex; flex-direction: column; align-items: flex-start;"
                    onsubmit="return confirmDelete();">
                    @csrf
                    @method('DELETE')


                    <div class="form-group mb-3" style="width: auto;">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter your password, if you need to delete your profile."
                            style="width: 500%; max-width: 400px;">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <button type="submit" class="btn btn-danger">
                        <i> Delete My Profile </i>
                    </button>
                </form>

                <script>
                    function confirmDelete() {
                        return confirm('Are you sure you want to delete your profile?');
                    }
                </script>
            </div>
