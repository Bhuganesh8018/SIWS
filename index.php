<?php
session_start();

// CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];

$message_status = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf_token']) {
        $message_status = '<p class="text-red-600 font-semibold mt-3">Security validation failed.</p>';
    } else {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $msg = htmlspecialchars(trim($_POST['message']));

        if ($name && $email && $msg) {
            $message_status = '<p class="text-green-600 font-semibold mt-3">Message sent successfully!</p>';
        } else {
            $message_status = '<p class="text-red-600 font-semibold mt-3">Please fill in all fields.</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- New Background & Colors (names/text kept same) -->
  <style>
    body {
      margin: 0;
      min-height: 100vh;
      font-family: inherit; /* do not change fonts */
      background:
        radial-gradient(circle at 0% 0%, rgba(56, 189, 248, 0.25), transparent 55%),
        radial-gradient(circle at 100% 100%, rgba(129, 140, 248, 0.35), transparent 55%),
        linear-gradient(135deg, #0f172a, #020617);
      background-attachment: fixed;
    }

    .card-glass {
      background: rgba(15, 23, 42, 0.9);
      box-shadow:
        0 18px 45px rgba(15, 23, 42, 0.9),
        0 0 0 1px rgba(148, 163, 184, 0.25);
      border-radius: 1.5rem;
      border: 1px solid rgba(148, 163, 184, 0.4);
      backdrop-filter: blur(26px);
    }

    .field {
      background: rgba(15, 23, 42, 0.8);
      border: 1px solid rgba(148, 163, 184, 0.5);
      transition: box-shadow 0.2s ease, border-color 0.2s ease, transform 0.1s ease;
    }

    .field:focus {
      outline: none;
      border-color: #38bdf8;
      box-shadow: 0 0 0 1px #38bdf8, 0 0 30px rgba(56, 189, 248, 0.3);
      transform: translateY(-1px);
    }

    .submit-btn {
      background: linear-gradient(135deg, #22c55e, #14b8a6);
      box-shadow: 0 16px 30px rgba(34, 197, 94, 0.45);
      transition: transform 0.12s ease, box-shadow 0.12s ease, filter 0.12s ease;
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 40px rgba(34, 197, 94, 0.6);
      filter: brightness(1.05);
    }

    .submit-btn:disabled {
      opacity: 0.7;
      cursor: not-allowed;
      box-shadow: none;
      transform: none;
    }

    .floating-blur {
      position: absolute;
      border-radius: 999px;
      filter: blur(65px);
      opacity: 0.7;
      pointer-events: none;
      z-index: -1;
    }
  </style>
</head>

<body class="flex items-center justify-center px-4 py-10">

  <!-- Decorative blobs -->
  <div class="floating-blur w-56 h-56 bg-cyan-400/50 -top-10 -left-10"></div>
  <div class="floating-blur w-72 h-72 bg-indigo-500/40 bottom-0 right-0"></div>

  <main class="w-full max-w-2xl relative">
    <section class="card-glass px-8 py-10 sm:px-10 sm:py-12">

      <!-- Header (name/title kept same) -->
      <div class="mb-8 text-center">
        <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">
          Contact Us
        </h1>
        <p class="mt-2 text-sm sm:text-base text-slate-300">
          Feel free to get in touch with us by filling out the form below.
        </p>
      </div>

      <!-- Form -->
      <form method="POST" onsubmit="return disableSubmit(this)" class="space-y-5">
        <input type="hidden" name="csrf" value="<?php echo $csrf; ?>" />

        <!-- Name (label kept same) -->
        <div class="space-y-1.5">
          <label class="block text-sm font-semibold text-slate-100">
            Name
          </label>
          <input
            type="text"
            name="name"
            class="field w-full rounded-xl px-3.5 py-2.5 text-slate-50 placeholder-slate-400 text-sm sm:text-base"
            placeholder="Enter your name"
          />
        </div>

        <!-- Email (label kept same) -->
        <div class="space-y-1.5">
          <label class="block text-sm font-semibold text-slate-100">
            Email
          </label>
          <input
            type="email"
            name="email"
            class="field w-full rounded-xl px-3.5 py-2.5 text-slate-50 placeholder-slate-400 text-sm sm:text-base"
            placeholder="Enter your email"
          />
        </div>

        <!-- Message (label kept same) -->
        <div class="space-y-1.5">
          <label class="block text-sm font-semibold text-slate-100">
            Message
          </label>
          <textarea
            name="message"
            rows="4"
            class="field w-full rounded-xl px-3.5 py-2.5 text-slate-50 placeholder-slate-400 text-sm sm:text-base resize-none"
            placeholder="Write your message"
          ></textarea>
        </div>

        <!-- Submit button -->
        <button
          type="submit"
          class="submit-btn w-full mt-3 rounded-xl py-3.5 text-sm sm:text-base font-semibold text-white flex items-center justify-center gap-2"
        >
          <span>Send Message</span>
        </button>

        <!-- Status message -->
        <div class="text-sm">
          <?php echo $message_status; ?>
        </div>
      </form>
    </section>

    <!-- Footer (names/text kept same) -->
    <p class="mt-5 text-center text-xs sm:text-sm text-slate-300/80">
      © <?php echo date("Y"); ?> Your Website | All Rights Reserved
    </p>
  </main>

  <script>
    function disableSubmit(form) {
      const btn = form.querySelector('button[type="submit"]');
      if (btn) {
        btn.disabled = true;
        btn.textContent = "Sending...";
      }
      return true;
    }
  </script>
</body>
</html>
