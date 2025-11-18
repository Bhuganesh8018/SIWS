<?php
// Simple PHP script for handling the contact form submission
$message_status = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's a contact form submission
    if (isset($_POST['contact_form'])) {
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $form_message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

        if (empty($name) || empty($email) || empty($form_message)) {
            $message_status = '<div class="bg-red-900/60 border-l-4 border-red-500 text-red-200 p-4 rounded-md" role="alert"><p>Please fill out all fields.</p></div>';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message_status = '<div class="bg-red-900/60 border-l-4 border-red-500 text-red-200 p-4 rounded-md" role="alert"><p>Invalid email format.</p></div>';
        } else {
            $to = 'info@siwscollege.edu.in'; // change if needed
            $subject = 'New Message from SIWS College Website Contact Form';
            $body = "Name: $name\n";
            $body .= "Email: $email\n\n";
            $body .= "Message:\n$form_message";
            $headers = "From: webmaster@siwscollege.com\r\n";
            $headers .= "Reply-To: $email\r\n";

            if (mail($to, $subject, $body, $headers)) {
                $message_status = '<div class="bg-emerald-900/60 border-l-4 border-emerald-400 text-emerald-200 p-4 rounded-md" role="alert"><p>Thank you for your message! We will get back to you shortly.</p></div>';
            } else {
                $message_status = '<div class="bg-red-900/60 border-l-4 border-red-500 text-red-200 p-4 rounded-md" role="alert"><p>Sorry, the email could not be sent. Please try again later.</p></div>';
            }
        }
    }
    // Placeholder for newsletter submission
    elseif (isset($_POST['newsletter_form'])) {
        // newsletter logic can go here
        $message_status = '<div class="bg-emerald-900/60 border-l-4 border-emerald-400 text-emerald-200 p-4 rounded-md" role="alert"><p>Thanks for subscribing!</p></div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<style>
  body {
    background: linear-gradient(135deg, #2e026d, #15162c);
    font-family: 'Poppins', sans-serif;
  }
</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIWS College - A Legacy of Excellence</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{
            --neon-cyan: #00f0ff;
            --neon-magenta: #ff3ecb;
            --neon-indigo: #7a5cff;
            --dark-bg: #070617;
        }
        html,body{
            background: radial-gradient(1200px 400px at 10% 10%, rgba(122,92,255,0.08), transparent 8%),
                        radial-gradient(900px 300px at 90% 90%, rgba(0,240,255,0.05), transparent 8%),
                        var(--dark-bg);
            color: #E6EEF6;
            font-family: 'Poppins', sans-serif;
            -webkit-font-smoothing:antialiased;
        }
        header {
            background: linear-gradient(135deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border-bottom: 1px solid rgba(255,255,255,0.03);
            backdrop-filter: blur(6px);
        }
        .logo-neon { font-weight:800; font-size:1.4rem; letter-spacing:0.3px; text-shadow: 0 0 8px rgba(122,92,255,0.25); }
        .logo-dot { color: var(--neon-cyan); text-shadow: 0 0 12px var(--neon-cyan); }
        .hero-bg {
            background-image: linear-gradient(180deg, rgba(7,6,23,0.75), rgba(7,6,23,0.75)), url('https://placehold.co/1920x1080/0b1220/ffffff?text=SIWS+Campus+Neon');
            background-size: cover; background-position: center; position: relative; overflow: hidden;
        }
        .neon-card { background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border:1px solid rgba(255,255,255,0.04); box-shadow:0 10px 40px rgba(7,6,23,0.6); backdrop-filter:blur(6px); }
        .btn-neon { background: linear-gradient(90deg, rgba(122,92,255,0.14), rgba(0,240,255,0.06)); border:1px solid rgba(0,240,255,0.12); box-shadow:0 6px 30px rgba(0,240,255,0.04); transition: transform .22s ease, box-shadow .22s ease; }
        .btn-neon:hover { transform: translateY(-4px) scale(1.02); box-shadow: 0 14px 40px rgba(0,240,255,0.08); }
        .glow-text { text-shadow: 0 0 16px rgba(122,92,255,0.28), 0 0 36px rgba(0,240,255,0.06); }
        .accent-border { position: relative; overflow: visible; }
        .accent-border::before{ content: ''; position: absolute; inset: -2px; z-index: -1; background: linear-gradient(90deg, rgba(122,92,255,0.08), rgba(0,240,255,0.06) 60%, rgba(255,62,203,0.04)); filter: blur(12px); opacity: 0.9; border-radius: 14px; }
        input[type="text"], input[type="email"], textarea { background: rgba(10,10,18,0.6); border: 1px solid rgba(255,255,255,0.04); box-shadow: inset 0 -6px 18px rgba(0,0,0,0.6); color: #e6eef6; }
        input:focus, textarea:focus { outline: none; box-shadow: 0 0 28px rgba(0,240,255,0.04), 0 6px 30px rgba(7,6,23,0.6); border-color: rgba(0,240,255,0.28); }
        .icon-floating i { transition: transform .35s ease, text-shadow .35s ease; }
        .icon-floating:hover i { transform: translateY(-6px) rotate(-8deg) scale(1.08); text-shadow: 0 0 12px rgba(0,240,255,0.12); }
        footer { background: linear-gradient(180deg, rgba(4,6,12,0.95), rgba(4,6,12,0.98)); border-top: 1px solid rgba(255,255,255,0.03); }
        .social-btn { width:44px; height:44px; display:inline-flex; align-items:center; justify-content:center; border-radius:8px; background: rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.03); transition: transform .22s ease, box-shadow .22s ease; }
        .social-btn:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(122,92,255,0.06); }
        @media (max-width: 768px) { .logo-neon { font-size: 1.15rem; } .section-title { font-size: 1.8rem; } }
    </style>
</head>
<body class="antialiased">

    <!-- Header & Navigation -->
    <header class="sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="logo-neon text-white flex items-center gap-2">
                <span class="text-2xl font-extrabold">SIWS</span>
                <span class="logo-dot">.</span>
            </a>
            <div class="hidden lg:flex space-x-8 items-center font-medium text-slate-300">
                <a href="#home" class="hover:text-white transition duration-200">Home</a>
                <a href="#about" class="hover:text-white transition duration-200">About</a>
                <a href="#academics" class="hover:text-white transition duration-200">Academics</a>
                <a href="#campus" class="hover:text-white transition duration-200">Campus Life</a>
                <a href="#placements" class="hover:text-white transition duration-200">Placements</a>
            </div>
            <div class="hidden lg:flex items-center gap-4">
                <a href="#contact" class="btn-neon text-slate-900 px-5 py-2 rounded-lg font-semibold shadow-sm">Get In Touch</a>
            </div>
            <button id="mobile-menu-button" class="lg:hidden text-slate-300 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
        <div id="mobile-menu" class="hidden lg:hidden bg-transparent border-t border-white/5">
            <a href="#home" class="block py-3 px-6 text-slate-300 hover:bg-white/2">Home</a>
            <a href="#about" class="block py-3 px-6 text-slate-300 hover:bg-white/2">About</a>
            <a href="#academics" class="block py-3 px-6 text-slate-300 hover:bg-white/2">Academics</a>
            <a href="#campus" class="block py-3 px-6 text-slate-300 hover:bg-white/2">Campus Life</a>
            <a href="#placements" class="block py-3 px-6 text-slate-300 hover:bg-white/2">Placements</a>
            <a href="#contact" class="block py-3 px-6 text-slate-300 hover:bg-white/2">Get In Touch</a>
        </div>
    </header>

    <!-- Hero -->
    <section id="home" class="hero-bg text-white min-h-screen flex items-center bg-cover bg-center">
        <div class="container mx-auto px-6 text-center">
            <div class="neon-card p-10 rounded-2xl inline-block max-w-3xl">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-4 glow-text">Empowering Future <span style="color:var(--neon-magenta); text-shadow:0 0 14px var(--neon-magenta)">Leaders</span></h1>
                <p class="text-lg md:text-xl mb-8 text-slate-300">Since 1932, SIWS College has been a cornerstone of academic excellence and holistic development.</p>
                <div class="flex gap-4 justify-center">
                    <a href="#academics" class="btn-neon px-6 py-3 rounded-lg text-sm font-semibold shadow-lg flex items-center gap-3">
                        <i class="fas fa-graduation-cap text-base" style="color:var(--neon-cyan)"></i>
                        Explore Programs
                    </a>
                    <a href="#contact" class="px-6 py-3 rounded-lg border border-white/6 text-slate-200 hover:scale-105 transition inline-flex items-center gap-2">
                        <i class="fas fa-phone-alt text-sm" style="color:var(--neon-indigo)"></i> Contact Admissions
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main -->
    <main class="container mx-auto px-6 py-24">
        <!-- About -->
        <section id="about" class="scroll-mt-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-3 glow-text">A Tradition of Excellence</h2>
                <p class="text-slate-300 max-w-3xl mx-auto">We are committed to nurturing talent and fostering an environment of intellectual growth and innovation.</p>
            </div>
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2">
                    <img src="https://placehold.co/600x450/07102b/9be7ff?text=SIWS+Legacy" alt="SIWS College History" class="rounded-xl shadow-2xl accent-border">
                </div>
                <div class="lg:w-1/2">
                    <h3 class="text-3xl font-semibold text-slate-100 mb-6">Our Mission & Vision</h3>
                    <p class="text-slate-300 mb-6 leading-relaxed">
                        Our mission is to provide an inclusive and challenging academic environment that fosters critical thinking, creativity, and social responsibility. We envision a community of learners who are prepared to make a positive impact on the world. At SIWS, we don't just educate; we empower.
                    </p>
                    <div class="space-y-6 mt-6">
                        <div class="flex items-start icon-floating">
                           <div class="flex-shrink-0 bg-gradient-to-br from-[#0f172a]/20 to-[#00121a]/10 text-teal-300 rounded-full h-12 w-12 flex items-center justify-center mr-4">
                               <i class="fas fa-users text-xl" style="color:var(--neon-cyan)"></i>
                           </div>
                           <div>
                               <p class="text-3xl font-bold text-slate-100">5000+</p>
                               <p class="text-slate-400">Students Enrolled</p>
                           </div>
                       </div>
                       <div class="flex items-start icon-floating">
                           <div class="flex-shrink-0 rounded-full h-12 w-12 flex items-center justify-center mr-4">
                               <i class="fas fa-chalkboard-teacher text-xl" style="color:var(--neon-magenta)"></i>
                           </div>
                           <div>
                               <p class="text-3xl font-bold text-slate-100">200+</p>
                               <p class="text-slate-400">Dedicated Faculty</p>
                           </div>
                       </div>
                       <div class="flex items-start icon-floating">
                           <div class="flex-shrink-0 rounded-full h-12 w-12 flex items-center justify-center mr-4">
                               <i class="fas fa-book-open text-xl" style="color:var(--neon-indigo)"></i>
                           </div>
                           <div>
                               <p class="text-3xl font-bold text-slate-100">15+</p>
                               <p class="text-slate-400">Academic Programs</p>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </section>

        <!-- Academics (short) -->
        <section id="academics" class="py-24 scroll-mt-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-3 glow-text">Pathways to Success</h2>
                <p class="text-slate-300 max-w-3xl mx-auto">Our diverse range of programs is designed to equip students with the knowledge and skills needed for a successful career.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group relative rounded-xl overflow-hidden shadow-lg transition-all duration-500 transform hover:-translate-y-2 h-96 neon-card accent-border">
                    <img src="https://placehold.co/600x800/051226/7fffd4?text=Innovation" alt="Science Program" class="absolute inset-0 w-full h-full object-cover opacity-30">
                    <div class="relative p-8 flex flex-col h-full justify-end text-white">
                        <i class="fas fa-atom text-4xl text-[#7fffd4] mb-4"></i>
                        <h3 class="text-3xl font-bold mb-2">Faculty of Science</h3>
                        <p class="mb-4 text-slate-300">Push the boundaries of innovation with our cutting-edge B.Sc. programs.</p>
                        <a href="#" class="font-semibold inline-block mt-2 text-slate-200">View Courses <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
                <div class="group relative rounded-xl overflow-hidden shadow-lg transition-all duration-500 transform hover:-translate-y-2 h-96 neon-card accent-border">
                    <img src="https://placehold.co/600x800/052033/99f6e4?text=Strategy" alt="Commerce Program" class="absolute inset-0 w-full h-full object-cover opacity-28">
                    <div class="relative p-8 flex flex-col h-full justify-end text-white">
                        <i class="fas fa-chart-line text-4xl text-[#99f6e4] mb-4"></i>
                        <h3 class="text-3xl font-bold mb-2">Faculty of Commerce</h3>
                        <p class="mb-4 text-slate-300">Build a strong foundation in business and finance with our B.Com and B.M.S. degrees.</p>
                        <a href="#" class="font-semibold inline-block mt-2 text-slate-200">View Courses <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
                <div class="group relative rounded-xl overflow-hidden shadow-lg transition-all duration-500 transform hover:-translate-y-2 h-96 neon-card accent-border">
                    <img src="https://placehold.co/600x800/2b1b58/c7d2fe?text=Culture" alt="Arts Program" class="absolute inset-0 w-full h-full object-cover opacity-26">
                    <div class="relative p-8 flex flex-col h-full justify-end text-white">
                        <i class="fas fa-palette text-4xl text-[#c7d2fe] mb-4"></i>
                        <h3 class="text-3xl font-bold mb-2">Faculty of Arts</h3>
                        <p class="mb-4 text-slate-300">Explore human culture, history, and society through our enriching B.A. programs.</p>
                        <a href="#" class="font-semibold inline-block mt-2 text-slate-200">View Courses <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact -->
        <section id="contact" class="bg-transparent -mx-6 px-6 py-24 scroll-mt-20">
             <div class="container mx-auto grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-slate-100 mb-4">Start Your Journey With Us</h2>
                    <p class="text-slate-300 mb-8">We're here to help you take the next step. Contact us for any inquiries about our programs, admissions process, or campus tours.</p>
                    <div class="space-y-4 text-slate-300">
                        <p class="flex items-start"><i class="fas fa-map-marker-alt text-[#00f0ff] mt-1 mr-4"></i><span>Wadala, Mumbai - 400031</span></p>
                        <p class="flex items-center"><i class="fas fa-phone text-[#7a5cff] mr-4"></i><span>+91-22-2411-4796</span></p>
                        <p class="flex items-center"><i class="fas fa-envelope text-[#ff3ecb] mr-4"></i><span>siwscollege@gmail.com</span></p>
                    </div>
                </div>
                <div class="bg-gradient-to-b from-white/2 to-white/1 p-8 rounded-xl shadow-lg neon-card">
                    <form action="siws-college.php#contact" method="post" class="space-y-6">
                        <input type="hidden" name="contact_form" value="1">
                        <?php if (!empty($message_status)) echo '<div class="mb-6">' . $message_status . '</div>'; ?>
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-200 mb-1">Full Name</label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-3 rounded-lg">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-200 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-lg">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-200 mb-1">Message</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 rounded-lg"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-gradient-to-r from-[#00f0ff]/30 via-[#7a5cff]/22 to-[#ff3ecb]/22 text-slate-900 font-bold py-3 px-6 rounded-lg hover:scale-[1.01] transition duration-200">
                                <i class="fas fa-paper-plane mr-2"></i> Send Inquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="text-slate-300">
        <div class="container mx-auto px-6 py-12">
            <div class="grid lg:grid-cols-3 gap-8 border-b border-white/5 pb-10 mb-8">
                <div class="lg:col-span-1">
                    <h3 class="text-3xl font-bold mb-2">SIWS<span class="text-[#00f0ff]">.</span></h3>
                    <p class="text-slate-400">A premier institution dedicated to academic excellence and student success since 1932.</p>
                </div>
                <div class="lg:col-span-2">
                    <h4 class="text-lg font-semibold mb-3">Subscribe to our Newsletter</h4>
                    <p class="text-slate-400 mb-4">Get the latest news, event updates, and admissions information delivered right to your inbox.</p>
                    <form action="siws-college.php" method="post" class="flex flex-col sm:flex-row gap-2">
                        <input type="hidden" name="newsletter_form" value="1">
                        <input type="email" name="newsletter_email" placeholder="Enter your email" required class="w-full px-4 py-3 rounded-lg bg-transparent border border-white/5 text-slate-200">
                        <button type="submit" class="bg-gradient-to-r from-[#7a5cff] to-[#00f0ff] px-6 py-3 rounded-lg font-semibold text-slate-900 shadow-md">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="flex flex-col-reverse md:flex-row justify-between items-center text-center md:text-left">
                <p class="text-slate-500 mt-4 md:mt-0">&copy; <span id="year"></span> SIWS College. All Rights Reserved.</p>
                <div class="flex items-center space-x-6">
                    <div class="flex space-x-4">
                        <a href="#about" class="text-slate-400 hover:text-white transition">About</a>
                        <a href="#academics" class="text-slate-400 hover:text-white transition">Academics</a>
                        <a href="#contact" class="text-slate-400 hover:text-white transition">Contact</a>
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="social-btn"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
        const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
        mobileMenuLinks.forEach(link => link.addEventListener('click', () => mobileMenu.classList.add('hidden')));

        // Set current year
        document.getElementById('year').textContent = new Date().getFullYear();

        // Simple intersection observer for fade-ins
        const sections = document.querySelectorAll('section');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.style.transition = 'opacity .7s ease-out, transform .7s ease-out';
                    io.unobserve(entry.target);
                }
            });
        }, {threshold: 0.12});
        sections.forEach(s => { s.classList.add('opacity-0', 'translate-y-6'); io.observe(s); });
    </script>
</body>
</html>
