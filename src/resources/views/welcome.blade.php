<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esa Corner - Kantin Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 flex justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg flex flex-col min-h-screen relative pb-20" 
         x-data="{
            step: 'home',
            openModal: false,
            selectedOutlet: null,
            outletName: '',
            
            orderType: 'solo',
            serviceType: 'dine_in',
            members: ['Mahasiswa'],
            newMember: '',
            activeMember: 'Mahasiswa',
            cart: [],
            
            menus: [
                { id: 1, name: 'Nasi Goreng Spesial', price: 15000 },
                { id: 2, name: 'Ayam Geprek Sambal Ijo', price: 18000 },
                { id: 3, name: 'Es Teh Manis', price: 5000 },
                { id: 4, name: 'Mie Goreng Telur', price: 12000 }
            ],

            currentOrderCode: 'ORD-' + Math.random().toString(36).substr(2, 6).toUpperCase(),
            orderStatus: 'pending',

            selectOutlet(id, name) {
                this.selectedOutlet = id;
                this.outletName = name;
                this.openModal = true;
            },

            startOrder() {
                if (!this.activeMember.trim()) return alert('Masukkan nama Anda!');
                this.members = [this.activeMember];
                this.openModal = false;
                this.step = 'outlet';
            },

            addMember() {
                if (this.newMember.trim() !== '' && !this.members.includes(this.newMember.trim())) {
                    this.members.push(this.newMember.trim());
                    this.activeMember = this.newMember.trim();
                    this.newMember = '';
                }
            },

            addItem(menu) {
                let existing = this.cart.find(i => i.id === menu.id && i.customer_name === this.activeMember);
                if (existing) {
                    existing.quantity++;
                } else {
                    this.cart.push({
                        id: menu.id,
                        name: menu.name,
                        price: menu.price,
                        quantity: 1,
                        customer_name: this.activeMember
                    });
                }
            },

            removeItem(menuId) {
                let index = this.cart.findIndex(i => i.id === menuId && i.customer_name === this.activeMember);
                if (index !== -1) {
                    if (this.cart[index].quantity > 1) {
                        this.cart[index].quantity--;
                    } else {
                        this.cart.splice(index, 1);
                    }
                }
            },

            getItemQty(menuId) {
                let item = this.cart.find(i => i.id === menuId && i.customer_name === this.activeMember);
                return item ? item.quantity : 0;
            },

            getTotal() {
                return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            },

            processPayment() {
                this.step = 'payment';
            },

            confirmPayment() {
                this.orderStatus = 'paid';
                this.step = 'status';
            }
         }">

        <!-- STEP 1: HOME -->
        <template x-if="step === 'home'">
            <div>
                <div class="relative bg-blue-900 text-white rounded-b-3xl p-6 pb-8 text-center shadow-md">
                    <h1 class="text-xl font-bold tracking-wide">Esa Cørner</h1>
                    <div class="mt-4 bg-blue-950/70 p-4 rounded-xl backdrop-blur-sm border border-blue-400/30">
                        <h2 class="text-lg font-bold">Halo Mahasiswa!</h2>
                        <p class="text-sm text-gray-200">Mau makan apa hari ini?</p>
                    </div>
                </div>

                <div class="p-4 flex-1">
                    <h3 class="font-bold text-gray-800 mb-3">Pilih Outlet</h3>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($outlets as $outlet)
                        <div @click="selectOutlet({{ $outlet->id }}, '{{$outlet->name }}')" 
                             class="cursor-pointer bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-2 rounded-xl text-center shadow transition transform active:scale-95">
                            <span class="text-sm block font-bold">{{ \$outlet->name }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-1">Popular Categories <span>🔥</span></h3>
                        <div class="grid grid-cols-3 gap-2">
                            <template x-for="menu in menus" :key="menu.id">
                                <div class="bg-gray-50 rounded-lg p-2 text-center border shadow-sm">
                                    <div class="w-full h-12 bg-gray-200 rounded-md mb-1 flex items-center justify-center text-xs text-gray-500">🍱</div>
                                    <p class="text-xs font-semibold text-gray-700 truncate" x-text="menu.name"></p>
                                    <p class="text-[11px] text-red-600 font-bold" x-text="'Rp ' + menu.price.toLocaleString('id-ID')"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Modal Opsi Pesan -->
        <div x-show="openModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 z-50" x-cloak>
            <div class="bg-white rounded-2xl p-5 w-full max-w-xs shadow-2xl text-center space-y-4">
                <h3 class="font-bold text-gray-800 text-lg" x-text="outletName"></h3>
                
                <div class="space-y-3">
                    <input type="text" x-model="activeMember" placeholder="Masukkan Nama Anda" class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-red-500 outline-none">
                    
                    <div class="space-y-2">
                        <button @click="orderType = 'solo'; startOrder()" class="w-full bg-orange-500 text-white font-medium py-2 rounded-lg text