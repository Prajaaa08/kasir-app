<div>
    <form wire:submit.prevent="simpan">
        <div class="form-group">
            <input type="text" class="form-style" placeholder="Your Full Name" wire:model="nama">
            <i class="input-icon uil uil-user"></i>
            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group mt-2">
            <input type="email" class="form-style" placeholder="Your Email" wire:model="email">
            <i class="input-icon uil uil-at"></i>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group mt-2">
            <input type="password" class="form-style" placeholder="Your Password" wire:model="password">
            <i class="input-icon uil uil-lock-alt"></i>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group mt-2">
            <select class="form-style" wire:model="peran">
                <option value="">Pilih Peran</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
            </select>
            @error('peran') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn mt-4">Submit</button>
    
        @if (session()->has('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
    </form>
    
</div>