<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { background-color: #222222; } </style>
</head>
<body class="flex items-center justify-center min-h-screen py-10">
    <div class="bg-[#0b0b0b] border border-[#d9138a] rounded-[24px] p-10 w-[420px] shadow-2xl">
        
        <div class="flex items-center gap-2 mb-6">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-6 h-6 object-contain drop-shadow-[0_0_10px_rgba(217,19,138,0.8)]">
            <span class="text-white font-semibold text-lg tracking-wide">Ticketify</span>
        </div>

        <h2 class="text-white text-[22px] font-medium text-center mb-6">Welcome to ticketify</h2>

        <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-500/20 border border-red-500 text-red-400 text-xs text-center px-4 py-2 rounded-full mb-4">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/proses_register') ?>" method="POST" class="flex flex-col gap-4">
            <div>
                <label class="text-white text-xs ml-3 mb-1 block">Name</label>
                <input type="text" name="name" class="w-full bg-[#d9d9d9] text-black font-medium rounded-full px-5 py-2 outline-none focus:ring-2 focus:ring-[#d9138a]" required>
            </div>
            <div>
                <label class="text-white text-xs ml-3 mb-1 block">Email</label>
                <input type="email" name="email" class="w-full bg-[#d9d9d9] text-black font-medium rounded-full px-5 py-2 outline-none focus:ring-2 focus:ring-[#d9138a]" required>
            </div>
            <div>
                <label class="text-white text-xs ml-3 mb-1 block">Phone Number</label>
                <input type="number" name="phone" class="w-full bg-[#d9d9d9] text-black font-medium rounded-full px-5 py-2 outline-none focus:ring-2 focus:ring-[#d9138a]" required>
            </div>
            <div>
                <label class="text-white text-xs ml-3 mb-1 block">Password</label>
                <input type="password" name="password" class="w-full bg-[#d9d9d9] text-black font-medium rounded-full px-5 py-2 outline-none focus:ring-2 focus:ring-[#d9138a]" required>
            </div>
            <div>
                <label class="text-white text-xs ml-3 mb-1 block">confirm password</label>
                <input type="password" name="confirm_password" class="w-full bg-[#d9d9d9] text-black font-medium rounded-full px-5 py-2 outline-none focus:ring-2 focus:ring-[#d9138a]" required>
            </div>
            <div class="flex items-center gap-2 ml-3 mt-1">
                <input type="checkbox" id="terms" class="w-3.5 h-3.5 bg-white border border-gray-400 rounded-sm cursor-pointer" required>
                <label for="terms" class="text-white text-xs cursor-pointer">I agree to the Terms & Conditions.</label>
            </div>
            <div class="mt-2">
                <button type="submit" class="border border-[#d9138a] text-white px-7 py-1.5 rounded-full text-sm font-medium hover:bg-[#d9138a] transition">Sign up</button>
            </div>
        </form>
        
        <div class="flex items-center gap-3 my-6">
            <div class="h-[1px] bg-gray-600 flex-1"></div>
            <span class="text-gray-400 text-xs">or</span>
            <div class="h-[1px] bg-gray-600 flex-1"></div>
        </div>
        <div class="text-left text-xs ml-2">
            <span class="text-gray-400 block mb-1">Already have an account ?</span>
            <a href="<?= base_url('auth/login') ?>" class="text-[#d9138a] hover:underline">Sign in</a>
        </div>
    </div>
</body>
</html>