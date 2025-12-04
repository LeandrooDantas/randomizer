<div>
    <div class="flex justify-center">
        <form wire:submit="login" class="w-full max-w-md px-8 py-6 bg-white rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-6 text-center">Login</h1>

                <label class="label">Email</label>
                <input wire:model="email" id="email" type="email" class="input w-full" placeholder="Email" />
                <label class="label">Password</label>
                <input wire:model="password" type="password" id="password" class="input w-full" placeholder="Password" />

                <input type="submit" value="Entrar" class="w-full mt-4 btn btn-neutral" />
        </form>
    </div>
</div>
