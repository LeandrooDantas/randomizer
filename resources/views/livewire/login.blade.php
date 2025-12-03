<div>
    <div class="flex justify-center items-center min-h-screen">
        <form wire:submit="login" >
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-7xl border p-4">
                <legend class="fieldset-legend text-2xl font-semibold">Login</legend>

                <label class="label">Email</label>
                <input wire:model="email" id="email" type="email" class="input w-full" placeholder="Email" />
                <label class="label">Password</label>
                <input wire:model="password" type="password" id="password" class="input w-full" placeholder="Password" />

                <input type="submit" value="Entrar" class="w-full mt-4 btn btn-neutral" />
            </fieldset>
        </form>
    </div>
</div>
