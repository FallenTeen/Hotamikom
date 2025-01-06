<footer class=" text-white bg-slate-800 py-16">
    <div class="container mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-8">
            <!-- Footer Links -->
            <div>
                <ul class="space-y-4" x-data="scrollToSection">
                    <li> <a href="#profile" @click.prevent="scrollTo('#profile')"
                            class="text-gray-400 hover:text-white transform transition-transform duration-300 ease-in-out hover:translate-y-1">
                            Tentang Kami
                        </a></li>
                    <li> <a href="#kamar" @click.prevent="scrollTo('#kamar')"
                            class="text-gray-400 hover:text-white transform transition-transform duration-300 ease-in-out hover:translate-y-1">
                            Kamar
                        </a></li>
                    <li><a href="{{ route('res') }}"
                            class="text-gray-400 hover:text-white transform transition-transform duration-300 ease-in-out hover:translate-y-1">
                            Reservasi
                        </a></li>
                </ul>
            </div>
            <div>
                <ul class="space-y-4" x-data="scrollToSection">
                    <li><a href="{{ route('room') }}" class="text-gray-400 hover:text-white">Kamar &amp; Suite</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Contact Us</a></li>
                    <li><a href="#layanans" @click.prevent="scrollTo('#layanans')"
                            class="text-gray-400 hover:text-white">Layanan Lainnya</a></li>
                </ul>
            </div>
            <div>
                <p class="text-gray-400">
                    <span class="block text-lg font-semibold">Alamat:</span>
                    <span>
                        Jl. Letjend Pol. Soemarto No.127, <br>
                        Watumas, Purwanegara, Kec. Purwokerto Utara, <br>
                        Kabupaten Banyumas, Jawa Tengah 53127
                    </span>
                </p>

                <p class="text-gray-400">
                    <span class="block text-lg font-semibold">Phone:</span>
                    <span>+62 857-1604-6094</span>
                </p>
                <p class="text-gray-400">
                    <span class="block text-lg font-semibold">Email:</span>
                    <span>Abdul@gmail.com</span>
                </p>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('scrollToSection', () => ({
                scrollTo(selector) {
                    const element = document.querySelector(selector);
                    if (element) {
                        const offset = 50;
                        const targetPosition = element.offsetTop - offset;
                        const startPosition = window.scrollY;
                        const distance = targetPosition - startPosition;
                        const duration = 800;
                        let startTime = null;

                        function animation(currentTime) {
                            if (!startTime) startTime = currentTime;
                            const timeElapsed = currentTime - startTime;
                            const run = easeInOutQuad(timeElapsed, startPosition, distance, duration);
                            window.scrollTo(0, run);
                            if (timeElapsed < duration) requestAnimationFrame(animation);
                        }

                        function easeInOutQuad(t, b, c, d) {
                            t /= d / 2;
                            if (t < 1) return c / 2 * t * t + b;
                            t--;
                            return -c / 2 * (t * (t - 2) - 1) + b;
                        }

                        requestAnimationFrame(animation);
                    }
                }
            }));
        });
    </script>

</footer>