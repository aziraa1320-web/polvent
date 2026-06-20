<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="POLVENT - Platform resmi manajemen event kampus Politeknik Negeri Bengkalis.">
    <title>POLVENT — Portal Event Politeknik Negeri Bengkalis</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #0f285c; /* Navy Khas Polvent */
            --primary-hover: #1e3a8a;
            --secondary: #2563eb; 
            --navy: #0f285c;
            --emerald: #059669;
            --text-main: #334155;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-light); color: var(--text-main); overflow-x: hidden; }
        h1, h2, h3, h4, .font-outfit { font-family: 'Outfit', sans-serif; }
        a { text-decoration: none; }

        /* ======= NAVBAR (GLASSMORPHISM) ======= */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.4);
            height: 72px; padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .navbar-brand { display: flex; align-items: center; gap: 0.8rem; }
        .navbar-logo { 
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 4px; height: 44px;
        }
        .navbar-logo img { height: 100%; width: auto; object-fit: contain; }
        .navbar-logo img.logo-polvent { height: 200%; width: auto; }
        
        .navbar-links { display: flex; gap: 2.5rem; }
        .navbar-links a { color: var(--text-main); font-size: 0.9rem; font-weight: 600; transition: all 0.2s; position: relative; }
        .navbar-links a:hover { color: var(--primary); }
        .navbar-links a.active { color: var(--primary); font-weight: 700; }
        .navbar-links a.active::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 100%; height: 2px; background: var(--primary); border-radius: 2px; }

        .navbar-auth { display: flex; gap: 1rem; align-items: center; }
        .btn-nav-register {
            background: var(--primary); color: white; padding: 0.5rem 1.5rem;
            border-radius: 999px; font-weight: 600; font-size: 0.95rem;
            transition: all 0.3s; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }
        .btn-nav-register:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4); }

        /* ======= HERO SECTION (CAMPUS BG + GLASS) ======= */
        .hero {
            position: relative;
            min-height: 100vh;
            padding-top: 72px;
            display: flex; align-items: center;
            /* Background image with neutral dark gradient overlay */
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.4) 100%), 
                        url('{{ asset("images/bg-kampus.jpg") }}') center/cover no-repeat fixed;
            overflow: hidden;
        }
        .hero-container {
            max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;
            display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
            width: 100%; position: relative; z-index: 2;
        }
        
        .hero-content { color: white; }
        .hero-badge {
            display: inline-block; padding: 0.4rem 1.2rem; border-radius: 50px;
            background: rgba(37, 99, 235, 0.2); border: 1px solid rgba(37, 99, 235, 0.4);
            color: #60a5fa; font-size: 0.85rem; font-weight: 600; margin-bottom: 1.5rem;
            backdrop-filter: blur(8px);
        }
        .hero h1 { font-size: clamp(2.5rem, 4vw, 3.8rem); font-weight: 900; line-height: 1.1; margin-bottom: 1.5rem; }
        .hero h1 span { color: #ffffff; text-shadow: 0 2px 12px rgba(255,255,255,0.2); }
        .hero p { font-size: 1.1rem; color: #cbd5e1; line-height: 1.6; margin-bottom: 2.5rem; max-width: 90%; }
        
        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-primary {
            background: white; color: var(--primary); padding: 0.875rem 2rem;
            border-radius: 999px; font-weight: 700; font-size: 1rem;
            display: flex; align-items: center; gap: 0.5rem;
            transition: all 0.3s; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }
        .btn-primary:hover { background: #f8fafc; transform: translateY(-3px); box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15); }
        
        .btn-secondary-glass {
            background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3);
            color: white; padding: 0.875rem 2rem; border-radius: 999px;
            font-weight: 600; font-size: 1rem; backdrop-filter: blur(10px);
            transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;
        }
        .btn-secondary-glass:hover { background: rgba(255, 255, 255, 0.2); transform: translateY(-3px); }

        /* GLASS CARDS IN HERO */
        .hero-visual { display: flex; flex-direction: column; gap: 1rem; }
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--secondary);
            border-radius: 16px; padding: 1.25rem 1.5rem;
            display: flex; align-items: flex-start; gap: 1rem;
            color: white; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover { transform: translateX(-5px) scale(1.02); border-color: rgba(255,255,255,0.3); background: rgba(255,255,255,0.12); box-shadow: 0 10px 30px rgba(0,0,0,0.25); border-left-color: #60a5fa; }
        
        .gc-icon { 
            width: 48px; height: 48px; border-radius: 12px; 
            background: rgba(255, 255, 255, 0.1); display: flex; align-items: center; justify-content: center; 
            font-size: 1.5rem; flex-shrink: 0;
        }
        .gc-content h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 0.25rem; }
        .gc-content p { font-size: 0.8rem; color: #94a3b8; line-height: 1.4; margin: 0; }

        /* ======= STATS FLOATING ======= */
        .stats-wrapper { margin-top: -60px; position: relative; z-index: 10; padding: 0 2rem; max-width: 1200px; margin-left: auto; margin-right: auto; }
        .stats-container {
            background: white; border-radius: 20px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            display: grid; grid-template-columns: repeat(4, 1fr);
            padding: 2.5rem 2rem; gap: 2rem; border: 1px solid #f1f5f9;
        }
        .stat-box { text-align: center; position: relative; }
        .stat-box:not(:last-child)::after {
            content: ''; position: absolute; right: -1rem; top: 10%; height: 80%;
            width: 1px; background: #e2e8f0;
        }
        .stat-num { font-size: 3rem; font-weight: 900; font-family: 'Outfit'; color: var(--navy); line-height: 1; margin-bottom: 0.5rem; }
        .stat-num span { color: var(--primary); }
        .stat-label { font-size: 0.85rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }

        /* ======= EVENTS SECTION ======= */
        .section-padding { padding: 6rem 2rem; max-width: 1200px; margin: 0 auto; }
        .section-header { margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end; }
        .section-title { font-size: 2.5rem; font-weight: 800; color: var(--navy); margin-bottom: 0.5rem; }
        .section-subtitle { color: var(--text-muted); font-size: 1.1rem; }
        .link-all { color: var(--primary); font-weight: 600; display: flex; align-items: center; gap: 0.5rem; transition: gap 0.3s; }
        .link-all:hover { gap: 0.75rem; }

        .events-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; }
        .event-card {
            background: white; border-radius: 20px; overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex; flex-direction: column;
        }
        .event-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1); border-color: #cbd5e1; }
        
        .ec-image { height: 200px; position: relative; background: linear-gradient(135deg, var(--primary), var(--secondary)); overflow: hidden; }
        .ec-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .event-card:hover .ec-image img { transform: scale(1.05); }
        .ec-date {
            position: absolute; top: 1rem; right: 1rem;
            background: rgba(255,255,255,0.9); backdrop-filter: blur(4px);
            padding: 0.5rem 0.75rem; border-radius: 12px;
            text-align: center; font-weight: 800; color: var(--navy);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .ec-date .day { font-size: 1.25rem; line-height: 1; }
        .ec-date .month { font-size: 0.7rem; text-transform: uppercase; color: var(--primary); }

        .ec-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
        .ec-title { font-size: 1.25rem; font-weight: 700; color: var(--navy); margin-bottom: 0.75rem; line-height: 1.3; }
        .ec-desc { color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        
        .ec-footer { margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #f1f5f9; }
        .ec-quota { font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.4rem; }
        .ec-quota strong { color: var(--emerald); font-size: 0.95rem; }
        .btn-card { background: var(--bg-light); color: var(--navy); padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; }
        .btn-card:hover { background: var(--navy); color: white; }

        /* ======= FEATURES SECTION ======= */
        .features-wrap { background: linear-gradient(135deg, var(--navy), #1e293b); color: white; padding: 4rem 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .feat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem; margin-top: 3rem; }
        .feat-item { padding: 2rem; background: rgba(255,255,255,0.03); border-radius: 24px; border: 1px solid rgba(255,255,255,0.05); transition: transform 0.3s; }
        .feat-item:hover { transform: translateY(-5px); background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); }
        .feat-icon { width: 64px; height: 64px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin-bottom: 1.5rem; }
        .feat-item h3 { font-size: 1.25rem; margin-bottom: 1rem; font-family: 'Outfit'; }
        .feat-item p { color: #94a3b8; font-size: 0.95rem; line-height: 1.6; }

        /* ======= FOOTER & FAQ ======= */
        .footer-container {
            background: #f8fafc;
            padding: 4rem 2rem 2rem;
            position: relative;
        }
        
        .footer-content { max-width: 1200px; margin: 0 auto; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 4rem; margin-bottom: 3rem; }
        .footer-brand p { font-size: 0.95rem; line-height: 1.6; max-width: 350px; color: #64748b; margin-top: 1rem; }
        .footer-title { color: var(--navy); font-weight: 700; font-family: 'Outfit'; font-size: 1.1rem; margin-bottom: 1.5rem; }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 0.8rem; }
        .footer-links a { color: #64748b; transition: color 0.2s; font-size: 0.9rem; }
        .footer-links a:hover { color: var(--primary); transform: translateX(4px); display: inline-block; }
        .footer-bottom { text-align: center; padding-top: 2rem; border-top: 1px solid #e2e8f0; font-size: 0.85rem; color: #94a3b8; }
        
        /* ======= FLOATING FAQ BUTTON ======= */
        .fab-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 999;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .fab-menu {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(15,40,92,0.18);
            margin-bottom: 1rem;
            padding: 0.5rem 0;
            display: flex;
            flex-direction: column;
            width: 270px;
            transform: scale(0.95);
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-origin: bottom right;
            border: 1px solid #e2e8f0;
        }
        .fab-menu.active {
            transform: scale(1);
            opacity: 1;
            visibility: visible;
        }
        .fab-item {
            padding: 0.85rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #1e293b;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: background 0.2s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            font-family: inherit;
        }
        .fab-item:hover { background: #f0f4ff; color: var(--navy); }
        .fab-item-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #e8eef7;
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .fab-item-icon svg { width: 16px; height: 16px; }
        .fab-item:hover .fab-item-icon { background: var(--navy); color: white; }
        
        .fab-button {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: var(--navy);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(15, 40, 92, 0.4);
            cursor: pointer;
            border: none;
            transition: all 0.25s ease;
        }
        .fab-button:hover { transform: scale(1.08); background: var(--primary-hover); box-shadow: 0 8px 24px rgba(15, 40, 92, 0.5); }
        .fab-button svg { width: 28px; height: 28px; }
        
        /* ======= FAQ MODAL ======= */
        .faq-modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 40, 92, 0.55); backdrop-filter: blur(6px);
            z-index: 1000; display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: all 0.3s;
        }
        .faq-modal-overlay.active { opacity: 1; visibility: visible; }
        .faq-modal-content {
            background: white; border-radius: 24px; padding: 2.5rem;
            width: 92%; max-width: 680px; transform: translateY(20px);
            transition: all 0.3s; max-height: 88vh; overflow-y: auto;
            box-shadow: 0 30px 60px rgba(15,40,92,0.2);
        }
        .faq-modal-overlay.active .faq-modal-content { transform: translateY(0); }
        .faq-modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .faq-modal-title { font-size: 1.4rem; font-weight: 800; color: var(--navy); font-family: 'Outfit'; }
        .faq-modal-close { background: #f1f5f9; border: none; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b; transition: all 0.2s; }
        .faq-modal-close:hover { background: var(--navy); color: white; }
        
        /* Tabs */
        /* Accordion FAQ */
        .accordion-item { border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; margin-bottom: 0.5rem; }
        .accordion-trigger {
            width: 100%; display: flex; justify-content: space-between; align-items: center;
            padding: 0.9rem 1.1rem; background: #f8fafc; border: none; cursor: pointer;
            font-weight: 600; font-size: 0.875rem; color: var(--navy); font-family: inherit;
            text-align: left; transition: background 0.2s;
        }
        .accordion-trigger:hover { background: #eef2ff; }
        .accordion-trigger.open { background: #eef2ff; color: var(--primary); }
        .accordion-arrow { width: 18px; height: 18px; flex-shrink: 0; transition: transform 0.25s ease; color: #94a3b8; }
        .accordion-trigger.open .accordion-arrow { transform: rotate(180deg); color: var(--navy); }
        .accordion-body {
            max-height: 0; overflow: hidden;
            transition: max-height 0.3s ease, padding 0.2s;
            background: white; font-size: 0.855rem; color: #475569; line-height: 1.65;
        }
        .accordion-body.open { max-height: 200px; padding: 0.85rem 1.1rem 1rem; }
        
        .guide-steps { display: flex; flex-direction: column; gap: 0.65rem; margin-bottom: 1.5rem; }
        .guide-step {
            display: flex; align-items: flex-start; gap: 0.85rem;
            padding: 0.85rem 1rem; background: #f0f4ff;
            border-radius: 12px; border-left: 3px solid var(--navy);
        }
        .guide-step-num {
            width: 26px; height: 26px; border-radius: 50%; background: var(--navy);
            color: white; font-weight: 800; font-size: 0.78rem;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .guide-step-text { font-size: 0.855rem; color: #1e293b; line-height: 1.5; }
        .guide-step-text strong { color: var(--navy); }
        
        .faq-section-title { font-size: 0.95rem; font-weight: 800; color: var(--navy); font-family: 'Outfit'; margin-bottom: 0.85rem; display: flex; align-items: center; gap: 0.5rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e8eef7; }
        .faq-accordion-list { display: flex; flex-direction: column; gap: 0.5rem; }
        
        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
        }

        /* ======= EVENT SLIDER ======= */
        .slider-outer {
            position: relative;
            overflow: hidden;
            padding: 1rem 0 1.5rem;
            cursor: grab;
            user-select: none;
        }
        .slider-outer:active { cursor: grabbing; }

        .slider-track {
            display: flex;
            gap: 1.5rem;
            padding: 0.5rem 2rem;
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
        }

        .slider-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 320px;
            max-width: 320px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .slider-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(15, 40, 92, 0.13);
            border-color: #bfdbfe;
        }

        .sc-image {
            height: 200px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }
        .sc-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .slider-card:hover .sc-image img { transform: scale(1.06); }

        .sc-image-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.6);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }
        .sc-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.45) 0%, transparent 60%);
        }
        .sc-date-badge {
            position: absolute; top: 1rem; right: 1rem;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            padding: 0.5rem 0.75rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 2;
        }
        .sc-date-day { display: block; font-size: 1.25rem; font-weight: 900; color: var(--navy); line-height: 1; }
        .sc-date-mon { display: block; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; color: var(--secondary); margin-top: 2px; }

        .sc-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
        .sc-title { font-size: 1.1rem; font-weight: 700; color: var(--navy); margin-bottom: 0.6rem; line-height: 1.35; }
        .sc-desc { color: var(--text-muted); font-size: 0.875rem; line-height: 1.6; flex: 1; margin-bottom: 1.25rem; }
        .sc-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid #f1f5f9; }
        .sc-quota { display: flex; align-items: center; gap: 0.4rem; font-size: 0.82rem; color: var(--text-muted); }
        .sc-quota strong { color: var(--emerald); font-weight: 700; }
        .sc-btn {
            background: var(--navy); color: white;
            padding: 0.45rem 1rem; border-radius: 8px;
            font-size: 0.8rem; font-weight: 600;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .sc-btn:hover { background: var(--secondary); color: white; transform: translateX(2px); }

        /* Arrow buttons */
        .slider-arrow {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 44px; height: 44px; border-radius: 50%;
            background: white; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            color: var(--navy);
            transition: all 0.2s;
            z-index: 10;
        }
        .slider-arrow:hover { background: var(--navy); color: white; transform: translateY(-50%) scale(1.1); }
        .slider-prev { left: 1rem; }
        .slider-next { right: 1rem; }

        /* Dots */
        .slider-dots {
            display: flex; justify-content: center; gap: 0.5rem;
            margin-top: 1.5rem;
        }
        .slider-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: #cbd5e1; border: none; cursor: pointer;
            transition: all 0.3s; padding: 0;
        }
        .slider-dot.active { width: 24px; border-radius: 99px; background: var(--navy); }

        /* ======= RESPONSIVE ======= */
        @media (max-width: 1024px) {
            .hero-container { grid-template-columns: 1fr; gap: 3rem; text-align: center; }
            .hero h1 { font-size: 2.8rem; }
            .hero p { margin: 0 auto 2.5rem; }
            .hero-actions { justify-content: center; }
            .hero-visual { display: none; }
            .stats-container { grid-template-columns: repeat(2, 1fr); gap: 2rem 0; padding: 2rem; }
            .stat-box:nth-child(2)::after { display: none; }
            .feat-grid { grid-template-columns: repeat(2, 1fr); }
            .slider-card { min-width: 280px; max-width: 280px; }
        }
        @media (max-width: 768px) {
            .navbar-links { display: none; }
            .section-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .stats-container { grid-template-columns: 1fr; gap: 2rem 0; }
            .stat-box::after { display: none; }
            .feat-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; gap: 2.5rem; }
            #about > div { grid-template-columns: 1fr !important; gap: 2rem !important; }
            #about img { display: none; }
            .slider-card { min-width: 260px; max-width: 260px; }
            .slider-arrow { display: none; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <div class="navbar-logo">
                <!-- Gunakan dua logo berdampingan -->
                <img src="{{ asset('images/logo-polbeng.png') }}" alt="Polbeng Logo">
                <img src="{{ asset('images/logo-polvent.png') }}" alt="Polvent Logo" class="logo-polvent">
            </div>
            <!-- Teks POLVENT dihapus sesuai permintaan -->
        </a>

        <div class="navbar-links">
            <a href="#home" class="nav-item">Beranda</a>
            <a href="#events" class="nav-item">Daftar Event</a>
            <a href="#features" class="nav-item">Keunggulan</a>
            <a href="#about" class="nav-item">Tentang Kami</a>
        </div>

        <div class="navbar-auth">
            @auth
                @php
                    $dashboardUrl = match(auth()->user()->role) {
                        'admin' => route('admin.dashboard'),
                        'panitia' => route('panitia.dashboard'),
                        default => route('dashboard')
                    };
                @endphp
                <a href="{{ $dashboardUrl }}" class="btn-nav-user" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; padding: 0.35rem 0.75rem; border-radius: 999px; background: rgba(79, 70, 229, 0.1); border: 1px solid rgba(79, 70, 229, 0.2); transition: all 0.3s;">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ Storage::url(auth()->user()->profile_photo) }}" alt="Profile" style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover; border: 1px solid var(--primary);">
                    @else
                        <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <span style="font-weight: 600; color: var(--navy); font-size: 0.9rem;">{{ auth()->user()->name }}</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer; color: #ef4444; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.3rem; padding: 0.5rem;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-nav-register">Login</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline-block;vertical-align:text-bottom;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    Platform Resmi Kampus
                </div>
                <h1>Portal Manajemen <br><span>Event Polbeng</span></h1>
                <p>Temukan, daftar, dan kelola partisipasi Anda dalam berbagai event kampus Politeknik Negeri Bengkalis secara digital dengan mudah, cepat, dan aman.</p>
                
                <div class="hero-actions">
                    <a href="#events" class="btn-primary">
                        Jelajahi Event
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="btn-secondary-glass">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            Login
                        </a>
                    @endguest
                </div>
            </div>

            <div class="hero-visual">
                <div class="glass-card">
                    <div class="gc-icon" style="color: #60a5fa;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="gc-content">
                        <h4>Manajemen Event Terpusat</h4>
                        <p>Kelola dan temukan seluruh kegiatan kampus dalam satu wadah terpadu.</p>
                    </div>
                </div>
                <div class="glass-card">
                    <div class="gc-icon" style="color: #34d399;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="gc-content">
                        <h4>Pendaftaran Tanpa Ribet</h4>
                        <p>Daftar event dengan satu klik, tanpa perlu mengisi formulir berulang kali.</p>
                    </div>
                </div>
                <div class="glass-card">
                    <div class="gc-icon" style="color: #fbbf24;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="gc-content">
                        <h4>Informasi Resmi & Valid</h4>
                        <p>Semua event telah diverifikasi dan disetujui langsung oleh institusi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <div class="stats-wrapper">
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total_events'] }}<span>+</span></div>
                <div class="stat-label">Event Tersedia</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total_mahasiswa'] }}<span>+</span></div>
                <div class="stat-label">Mahasiswa</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total_pendaftar'] }}<span>+</span></div>
                <div class="stat-label">Pendaftaran</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total_panitia'] }}<span>+</span></div>
                <div class="stat-label">Panitia Aktif</div>
            </div>
        </div>
    </div>

    <!-- UPCOMING EVENTS -->
    <section style="padding: 4rem 0 2.5rem 0; background: var(--bg-light); border-bottom: 1px solid #cbd5e1;" id="events">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <div class="section-header">
                <div>
                    <h2 class="section-title">Event Kampus Terbaru</h2>
                    <p class="section-subtitle">Jangan lewatkan kesempatan untuk mengembangkan diri Anda.</p>
                </div>
                <a href="{{ route('login') }}" class="link-all">
                    Lihat Semua Event
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>

        @if($events->count() > 0)
        <!-- SLIDER WRAPPER -->
        <div class="slider-outer">
            <div class="slider-track" id="sliderTrack">
                @foreach($events as $event)
                <div class="slider-card">
                    <div class="sc-image">
                        @if($event->poster)
                            <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}">
                        @else
                            <div class="sc-image-placeholder">
                                <svg width="52" height="52" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="sc-date-badge">
                            <span class="sc-date-day">{{ $event->event_date->format('d') }}</span>
                            <span class="sc-date-mon">{{ $event->event_date->format('M') }}</span>
                        </div>
                        <div class="sc-overlay"></div>
                    </div>
                    <div class="sc-body">
                        <h3 class="sc-title">{{ $event->title }}</h3>
                        <p class="sc-organizer" style="font-size:0.8rem; color:var(--primary); font-weight:600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.3rem;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            {{ $event->organizer ?? 'Polbeng' }}
                        </p>
                        <p class="sc-desc">{{ Str::limit($event->description, 90) }}</p>
                        <div class="sc-footer">
                            <div class="sc-quota">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Kuota: <strong>{{ $event->quota }}</strong></span>
                            </div>
                            <a href="#" class="sc-btn" onclick="openEventModal({{ $event->id }}); return false;">Lihat Detail →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Arrow buttons -->
            <button class="slider-arrow slider-prev" id="sliderPrev" aria-label="Previous">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button class="slider-arrow slider-next" id="sliderNext" aria-label="Next">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

        <!-- Dots -->
        <div class="slider-dots" id="sliderDots">
            @foreach($events as $i => $event)
                <button class="slider-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}" aria-label="Slide {{ $i+1 }}"></button>
            @endforeach
        </div>

        @else
        <div style="max-width:1200px;margin:0 auto;padding:0 2rem;">
            <div style="text-align:center;padding:4rem;background:white;border-radius:24px;border:1px dashed #cbd5e1;">
                <div style="margin-bottom:1rem;color:#94a3b8;display:flex;justify-content:center;">
                    <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-outfit" style="font-size:1.5rem;color:var(--navy);margin-bottom:0.5rem;">Belum ada event dibuka</h3>
                <p style="color:var(--text-muted);">Silakan cek kembali secara berkala untuk event terbaru.</p>
            </div>
        </div>
        @endif
    </section>

    <!-- FEATURES / KEUNGGULAN -->
    <section class="features-wrap" id="features">
        <div class="section-padding" style="padding-top:0;padding-bottom:0;">
            <div style="text-align:center;max-width:700px;margin:0 auto;">
                <h2 class="section-title" style="color:white;">Kenapa Memilih POLVENT?</h2>
                <p style="color:#94a3b8;font-size:1.1rem;margin-top:1rem;">Platform digitalisasi manajemen event yang dirancang khusus menyesuaikan kebutuhan administrasi dan kegiatan mahasiswa Polbeng.</p>
            </div>

            <div class="feat-grid">
                <div class="feat-item">
                    <div class="feat-icon" style="background:rgba(59, 130, 246, 0.2);color:#60a5fa;">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3>Tepat Sasaran</h3>
                    <p>Semua informasi event berasal dari sumber resmi dan dikurasi oleh panitia serta disetujui langsung oleh pihak admin institusi.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon" style="background:rgba(16, 185, 129, 0.2);color:#34d399;">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3>Real-Time Processing</h3>
                    <p>Sistem pendaftaran yang sangat responsif. Anda akan langsung tahu status penerimaan dan antrian kuota dalam hitungan detik.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon" style="background:rgba(245, 158, 11, 0.2);color:#fbbf24;">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3>Privasi & Keamanan</h3>
                    <p>Data pribadi mahasiswa dilindungi secara ketat. Tidak ada data yang dibagikan tanpa izin, semua aktivitas tercatat aman di Log Sistem.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT US / TENTANG KAMI -->
    <section id="about" style="background: var(--navy); color: white; position: relative; overflow: hidden; padding: 4rem 2rem 8rem 2rem; margin-top: 0;">
        <!-- Decorative Background Elements -->
        <div style="position: absolute; top: -20%; right: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(96,165,250,0.15) 0%, rgba(255,255,255,0) 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -20%; left: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(52,211,153,0.1) 0%, rgba(255,255,255,0) 70%); border-radius: 50%;"></div>

        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 5rem; align-items: center; max-width: 1200px; margin: 0 auto; position: relative; z-index: 2;" class="about-grid">
            <!-- Left Content -->
            <div style="padding-right: 2rem;" class="about-content">
                <div style="display: inline-block; padding: 0.4rem 1.2rem; border-radius: 50px; background: rgba(255, 255, 255, 0.1); color: #60a5fa; font-size: 0.85rem; font-weight: 700; margin-bottom: 1.5rem; letter-spacing: 0.5px; border: 1px solid rgba(255,255,255,0.2);">TENTANG POLVENT</div>
                <h2 class="section-title" style="font-size: clamp(2rem, 3vw, 2.8rem); line-height: 1.2; margin-bottom: 1.5rem; color: white;">Revolusi Digital<br><span style="color: #60a5fa;">Manajemen Event Kampus</span></h2>
                
                <p style="color: #cbd5e1; font-size: 1.1rem; line-height: 1.8; margin-bottom: 1.5rem;">
                    <strong>POLVENT</strong> (Politeknik Event) adalah inovasi digital terdepan yang dirancang khusus untuk menciptakan ekosistem kegiatan mahasiswa yang cerdas dan terintegrasi di Politeknik Negeri Bengkalis.
                </p>
                <p style="color: #cbd5e1; font-size: 1.05rem; line-height: 1.8; margin-bottom: 2.5rem;">
                    Kami mentransformasi proses birokrasi konvensional menjadi pengalaman digital yang mulus (seamless), menghubungkan penyelenggara acara dan mahasiswa dalam satu platform modern yang transparan, efisien, dan paperless.
                </p>

                <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                    <div style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 20px; flex: 1; min-width: 200px; border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                        <h4 style="color: white; font-weight: 800; font-family: 'Outfit'; margin-bottom: 0.5rem; font-size: 1.2rem;">Visi Kami</h4>
                        <p style="font-size: 0.9rem; color: #94a3b8; line-height: 1.6;">Menjadi sentra informasi tunggal yang tepercaya, mewujudkan tata kelola event yang cerdas, cepat, dan ramah lingkungan.</p>
                    </div>
                     <div style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 20px; flex: 1; min-width: 200px; border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                        <h4 style="color: white; font-weight: 800; font-family: 'Outfit'; margin-bottom: 0.5rem; font-size: 1.2rem;">Misi Kami</h4>
                        <p style="font-size: 0.9rem; color: #94a3b8; line-height: 1.6;">Menghadirkan kemudahan akses, meningkatkan partisipasi mahasiswa, dan mengamankan setiap data kegiatan secara real-time.</p>
                    </div>
                </div>
            </div>

            <!-- Right Visual -->
            <div style="position: relative; display: flex; justify-content: center; align-items: center;" class="about-visual">
                <div style="position: absolute; inset: 0; background: linear-gradient(135deg, #60a5fa 0%, #34d399 100%); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; opacity: 0.2; transform: scale(1.1); filter: blur(30px); animation: morph 8s ease-in-out infinite;"></div>
                <div style="background: rgba(255, 255, 255, 0.05); border-radius: 32px; padding: 3rem; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255,255,255,0.15); position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%; max-width: 400px; backdrop-filter: blur(16px);">
                    <div style="background: white; padding: 1.5rem; border-radius: 50%; margin-bottom: 2rem; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                        <img src="{{ asset('images/logo-polvent.png') }}" alt="POLVENT" style="width: 140px; height: auto;">
                    </div>
                    <h3 style="font-family: 'Outfit'; color: white; font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem;">Politeknik Event</h3>
                    <p style="color: #cbd5e1; font-size: 1rem;">Platform Manajemen Event Kampus Polbeng</p>
                </div>
                <style>
                    @keyframes morph {
                        0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
                        50% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; }
                        100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
                    }
                    @media (max-width: 768px) {
                        .about-grid { grid-template-columns: 1fr !important; gap: 3rem !important; }
                        #about { margin: 2rem 1rem !important; padding: 4rem 1.5rem !important; border-radius: 24px !important; }
                        .about-content { padding-right: 0 !important; text-align: center; }
                        .about-visual { display: flex !important; }
                    }
                </style>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer-container">
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div style="display:flex;align-items:center;gap:1rem;height:54px;">
                        <img src="{{ asset('images/logo-polbeng.png') }}" alt="Polbeng" style="height:100%;width:auto;object-fit:contain;">
                        <div style="width: 2px; height: 100%; background: #e2e8f0;"></div>
                        <img src="{{ asset('images/logo-polvent.png') }}" alt="Polvent" style="height:220%;width:auto;object-fit:contain;">
                    </div>
                    <p>
                        Pusat informasi dan pendaftaran seluruh event kampus Politeknik Negeri Bengkalis terintegrasi. Lebih mudah, cepat, dan 100% aman.
                    </p>
                    <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
                        <a href="#" style="width: 36px; height: 36px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: var(--navy); transition: all 0.2s;"><svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" style="width: 36px; height: 36px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: var(--navy); transition: all 0.2s;"><svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.20 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">Jelajahi</h4>
                    <ul class="footer-links">
                        <li><a href="#events">Daftar Event</a></li>
                        <li><a href="#features">Keunggulan Platform</a></li>
                        <li><a href="{{ route('login') }}">Portal Mahasiswa</a></li>
                        <li><a href="{{ route('panitia.login') }}">Akses Panitia</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-title">Hubungi Kami</h4>
                    <ul class="footer-links">
                        <li style="display:flex;align-items:center;gap:0.5rem;color:#64748b;font-size:0.9rem;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Sungai Alam, Bengkalis
                        </li>
                        <li style="display:flex;align-items:center;gap:0.5rem;color:#64748b;font-size:0.9rem;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            polvent02@gmail.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {{ date('Y') }} Platform POLVENT - Politeknik Negeri Bengkalis. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- EVENT DATA JSON (for modal) -->
    <script id="eventsData" type="application/json">
        {!! json_encode(\App\Models\Event::with('creator')->get()->map(function($ev) {
            return [
                'id' => $ev->id,
                'title' => $ev->title,
                'description' => $ev->description,
                'event_date' => $ev->event_date->format('d F Y, H:i') . ' WIB',
                'quota' => $ev->quota,
                'location' => $ev->location ?? 'Belum ditentukan',
                'organizer' => $ev->organizer ?? 'Polbeng',
                'poster' => $ev->poster ? \Illuminate\Support\Facades\Storage::url($ev->poster) : '',
                'approved' => $ev->approvedRegistrations()->count()
            ];
        })) !!}
    </script>

    <!-- EVENT DETAIL MODAL -->
    <div id="eventDetailModal" onclick="closeEventModal(event)" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.65); backdrop-filter:blur(8px); align-items:center; justify-content:center; padding:1rem;">
        <div onclick="event.stopPropagation()" style="background:white; border-radius:24px; max-width:760px; width:100%; max-height:90vh; overflow-y:auto; box-shadow:0 30px 60px rgba(0,0,0,0.3); position:relative;">
            <!-- Header image -->
            <div id="edPoster" style="width:100%; background:linear-gradient(135deg, #0f285c, #1e3a8a); border-radius:24px 24px 0 0; overflow:hidden; position:relative; display:flex; align-items:center; justify-content:center;">
                <img id="edPosterImg" src="" alt="" style="width:100%; max-height:550px; object-fit:contain; display:none; background:rgba(0,0,0,0.2);">
                <div id="edPosterPlaceholder" style="display:flex; align-items:center; justify-content:center; height:280px; width:100%;">
                    <svg width="80" height="80" fill="none" stroke="rgba(255,255,255,0.4)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <!-- Close button over poster -->
                <button onclick="closeEventModal()" style="position:absolute; top:1rem; right:1rem; background:rgba(0,0,0,0.5); border:none; color:white; width:36px; height:36px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; backdrop-filter:blur(8px);">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <!-- Body -->
            <div style="padding:2rem;">
                <div style="display:flex; gap:0.75rem; flex-wrap:wrap; margin-bottom:1rem;">
                    <span id="edDateBadge" style="display:inline-flex; align-items:center; gap:0.4rem; background:#eff6ff; color:#1d4ed8; padding:0.35rem 0.875rem; border-radius:999px; font-size:0.8rem; font-weight:700;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span id="edDate"></span>
                    </span>
                    <span id="edQuotaBadge" style="display:inline-flex; align-items:center; gap:0.4rem; background:#d1fae5; color:#059669; padding:0.35rem 0.875rem; border-radius:999px; font-size:0.8rem; font-weight:700;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Kuota: <strong><span id="edQuota"></span></strong>
                    </span>
                </div>
                <h2 id="edTitle" style="font-family:'Outfit',sans-serif; font-size:1.6rem; font-weight:800; color:#0f172a; margin-bottom:0.75rem; line-height:1.3;"></h2>
                <!-- Info row -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem; margin-bottom:1.5rem;" class="ed-info-grid">
                    <div style="display:flex; align-items:center; gap:0.5rem; background:#f8fafc; padding:0.75rem 1rem; border-radius:12px; border:1px solid #e2e8f0;">
                        <svg width="18" height="18" fill="none" stroke="#0f285c" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <div>
                            <div style="font-size:0.7rem; color:#64748b; font-weight:600; text-transform:uppercase;">Penyelenggara</div>
                            <div id="edOrganizer" style="font-weight:700; color:#1e293b; font-size:0.9rem;"></div>
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:0.5rem; background:#f8fafc; padding:0.75rem 1rem; border-radius:12px; border:1px solid #e2e8f0;">
                        <svg width="18" height="18" fill="none" stroke="#0f285c" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <div>
                            <div style="font-size:0.7rem; color:#64748b; font-weight:600; text-transform:uppercase;">Lokasi</div>
                            <div id="edLocation" style="font-weight:700; color:#1e293b; font-size:0.9rem;"></div>
                        </div>
                    </div>
                </div>
                <!-- Description -->
                <div style="margin-bottom:2rem;">
                    <h4 style="font-size:0.875rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.75rem;">Deskripsi Event</h4>
                    <p id="edDescription" style="color:#374151; font-size:0.95rem; line-height:1.75; white-space:pre-wrap;"></p>
                </div>
                <!-- CTA -->
                <div style="display:flex; gap:1rem; flex-wrap:wrap;">
                    <a href="{{ route('register') }}" style="flex:1; min-width:180px; background:#0f285c; color:white; border:none; padding:0.875rem 1.5rem; border-radius:14px; font-weight:700; font-size:0.95rem; cursor:pointer; text-align:center; display:flex; align-items:center; justify-content:center; gap:0.5rem; text-decoration:none; transition:all 0.2s;" onmouseover="this.style.background='#1e3a8a'" onmouseout="this.style.background='#0f285c'">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Daftar / Login untuk Ikuti Event
                    </a>
                    <button onclick="closeEventModal()" style="padding:0.875rem 1.25rem; border-radius:14px; border:1.5px solid #cbd5e1; background:white; color:#64748b; font-weight:600; cursor:pointer; transition:all 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <style>
        #eventDetailModal { display: none; }
        #eventDetailModal.open { display: flex !important; }
        @media (max-width: 640px) {
            .ed-info-grid { grid-template-columns: 1fr !important; }
        }
    </style>

    <!-- FAB CONTAINER -->
    <div class="fab-container">
        <div class="fab-menu" id="fabMenu">
            <button class="fab-item" onclick="openFaqModal()">
                <span>FAQ / Pertanyaan</span>
                <div class="fab-item-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
            </button>
            <button class="fab-item" onclick="openLaporanModal()">
                <span>Laporan Kendala</span>
                <div class="fab-item-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg></div>
            </button>
        </div>
        <button class="fab-button" onclick="toggleFabMenu()">
            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/></svg>
        </button>
    </div>

    <!-- FAQ MODAL -->
    <div class="faq-modal-overlay" id="faqModal" onclick="closeFaqModal(event)">
        <div class="faq-modal-content" onclick="event.stopPropagation()">
            <div class="faq-modal-header">
                <h3 class="faq-modal-title">📖 Panduan Mahasiswa POLVENT</h3>
                <button class="faq-modal-close" onclick="closeFaqModal()">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- FAQ ACCORDION -->
            <div class="faq-section-title" style="margin-top: 0.5rem;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pertanyaan yang Sering Diajukan
            </div>
            <div class="faq-accordion-list">
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Apakah saya perlu verifikasi OTP setiap kali login?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Tidak. Verifikasi OTP hanya dilakukan satu kali pada saat pendaftaran atau login pertama kali. Setelah akun terverifikasi, Anda bisa langsung masuk di waktu berikutnya.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Bagaimana jika kode OTP saya tidak masuk ke WhatsApp?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Pastikan nomor WhatsApp yang terdaftar di profil sudah benar dan aktif. Coba klik "Kirim Ulang OTP". Jika tetap tidak masuk, Anda dapat melaporkannya melalui tombol Laporan Kendala.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Bisakah saya mengubah Email atau NIM?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Tidak bisa. Email dan NIM terkunci setelah registrasi untuk menjaga integritas data akademik. Jika ada kesalahan, laporkan melalui tombol Laporan Kendala.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Bagaimana cara mendaftar ke suatu event?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Login ke portal mahasiswa → buka menu "Daftar Event" → klik event yang diminati → klik tombol "Daftar Event". Jika kuota masih tersedia, pendaftaran langsung tercatat otomatis.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Apakah ada batasan jumlah event yang bisa diikuti?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Tidak ada batasan maksimum. Namun pastikan jadwal event tidak bertabrakan. Setiap event memiliki kuota terbatas, jadi daftarkan diri Anda lebih awal.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Bagaimana cara melihat status pendaftaran event saya?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Buka menu "Riwayat Saya" di Dashboard Mahasiswa. Di sana Anda bisa melihat daftar event yang telah didaftar beserta status: Menunggu, Diterima, atau Ditolak.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Apakah saya bisa membatalkan pendaftaran event?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Pembatalan pendaftaran tergantung kebijakan panitia event. Jika perlu pembatalan, silakan hubungi panitia event terkait atau lapor melalui Laporan Kendala.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Bagaimana cara mengunggah atau mengganti foto profil?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Masuk ke menu "Profil Saya", klik tombol "Unggah Foto Baru", pilih file gambar (JPG/PNG/WebP, maks 2MB), lalu klik "Simpan Perubahan". Foto akan langsung diperbarui di seluruh halaman.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Apa yang terjadi jika kuota event sudah penuh?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Jika kuota penuh, tombol "Daftar" tidak akan tersedia. Anda bisa memantau halaman event secara berkala jika ada kemungkinan kuota dibuka kembali oleh panitia.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="toggleAccordion(this)">Kepada siapa saya melapor jika ada kendala sistem?<svg class="accordion-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div class="accordion-body">Gunakan tombol <strong>Laporan Kendala</strong>. Jelaskan detail kendala yang dialami agar dapat segera ditangani oleh admin POLVENT.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="faq-modal-overlay" id="laporanModal" onclick="closeLaporanModal(event)">
        <div class="faq-modal-content" style="max-width: 500px;" onclick="event.stopPropagation()">
            <div class="faq-modal-header">
                <h3 class="faq-modal-title">Laporan & Saran</h3>
                <button class="faq-modal-close" onclick="closeLaporanModal()">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1.5rem;">
                Kirimkan laporan kendala, pertanyaan, atau saran Anda langsung ke admin. Kami akan merespon secepatnya.
            </p>

            <form action="mailto:polvent02@gmail.com" method="GET" enctype="text/plain" class="laporan-form" id="laporanForm">
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem; color: var(--navy);">Subjek</label>
                    <select name="subject" required style="width: 100%; padding: 0.75rem; border: 1.5px solid #cbd5e1; border-radius: 12px; font-family: inherit; font-size: 0.9rem; outline: none;">
                        <option value="Laporan Kendala Sistem">Laporan Kendala Sistem</option>
                        <option value="Pertanyaan Seputar Event">Pertanyaan Seputar Event</option>
                        <option value="Saran & Masukan">Saran & Masukan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem; color: var(--navy);">Pesan / Detail Kendala</label>
                    <textarea name="body" required rows="5" placeholder="Jelaskan kendala atau saran Anda secara detail..." style="width: 100%; padding: 0.75rem; border: 1.5px solid #cbd5e1; border-radius: 12px; font-family: inherit; font-size: 0.9rem; outline: none; resize: vertical;"></textarea>
                </div>

                <button type="submit" style="width: 100%; background: var(--navy); color: white; border: none; padding: 0.875rem; border-radius: 12px; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 0.5rem;" onmouseover="this.style.background='var(--primary-hover)'" onmouseout="this.style.background='var(--navy)'">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Kirim Laporan via Email
                </button>
            </form>
        </div>
    </div>

    <script>
    // =================== EVENT SLIDER ===================
    (function() {
        const track = document.getElementById('sliderTrack');
        if (!track) return;

        const allCards = Array.from(track.querySelectorAll('.slider-card'));
        const totalReal = allCards.length;
        if (totalReal === 0) return;

        const dots = document.querySelectorAll('.slider-dot');
        const cardWidth = allCards[0].offsetWidth + 24; // width + gap (1.5rem=24px)

        let currentIndex = 0;
        let isDragging = false;
        let startX = 0;
        let startTranslate = 0;
        let currentTranslate = 0;

        function getTranslate() {
            return -(currentIndex * cardWidth);
        }

        function goTo(index, animated = true) {
            if (!animated) track.style.transition = 'none';
            else track.style.transition = 'transform 0.8s cubic-bezier(0.25, 1, 0.5, 1)'; // Halus dan lembut

            currentIndex = index;
            currentTranslate = getTranslate();
            track.style.transform = `translateX(${currentTranslate}px)`;

            // Update dots
            dots.forEach((d, i) => d.classList.toggle('active', i === currentIndex));
            
            // Hide/Show arrows based on position
            const btnPrev = document.getElementById('sliderPrev');
            const btnNext = document.getElementById('sliderNext');
            
            // Calculate how many items are visible
            const visibleItems = Math.floor(track.parentElement.offsetWidth / cardWidth);
            const maxIndex = Math.max(0, totalReal - visibleItems);

            if (btnPrev) {
                btnPrev.style.display = 'flex'; // Selalu tampilkan
                btnPrev.style.opacity = currentIndex === 0 ? '0.3' : '1';
                btnPrev.style.pointerEvents = currentIndex === 0 ? 'none' : 'auto';
            }
            
            if (btnNext) {
                btnNext.style.display = 'flex'; // Selalu tampilkan
                btnNext.style.opacity = currentIndex >= maxIndex ? '0.3' : '1';
                btnNext.style.pointerEvents = currentIndex >= maxIndex ? 'none' : 'auto';
            }
            
            if (document.getElementById('sliderDots')) {
                document.getElementById('sliderDots').style.display = totalReal <= visibleItems ? 'none' : 'flex';
            }
        }

        function next() {
            const visibleItems = Math.floor(track.parentElement.offsetWidth / cardWidth);
            const maxIndex = Math.max(0, totalReal - visibleItems);
            
            if (currentIndex >= maxIndex) return;
            currentIndex++;
            goTo(currentIndex);
        }

        function prev() {
            if (currentIndex <= 0) return;
            currentIndex--;
            goTo(currentIndex);
        }

        // Arrow buttons
        const btnPrev = document.getElementById('sliderPrev');
        const btnNext = document.getElementById('sliderNext');
        if (btnPrev) btnPrev.addEventListener('click', () => { prev(); });
        if (btnNext) btnNext.addEventListener('click', () => { next(); });

        // Dot buttons
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => { goTo(i); });
        });

        // Mouse drag
        track.addEventListener('mousedown', e => {
            isDragging = true;
            startX = e.clientX;
            startTranslate = currentTranslate;
            track.style.transition = 'none';
        });
        window.addEventListener('mousemove', e => {
            if (!isDragging) return;
            const diff = e.clientX - startX;
            track.style.transform = `translateX(${startTranslate + diff}px)`;
        });
        window.addEventListener('mouseup', e => {
            if (!isDragging) return;
            isDragging = false;
            const diff = e.clientX - startX;
            if (diff < -60) next();
            else if (diff > 60) prev();
            else goTo(currentIndex);
        });

        // Touch drag
        track.addEventListener('touchstart', e => {
            startX = e.touches[0].clientX;
            startTranslate = currentTranslate;
            track.style.transition = 'none';
        }, { passive: true });
        track.addEventListener('touchmove', e => {
            const diff = e.touches[0].clientX - startX;
            track.style.transform = `translateX(${startTranslate + diff}px)`;
        }, { passive: true });
        track.addEventListener('touchend', e => {
            const diff = e.changedTouches[0].clientX - startX;
            if (diff < -50) next();
            else if (diff > 50) prev();
            else goTo(currentIndex);
        });

        // Init
        window.addEventListener('resize', () => goTo(currentIndex, false));
        goTo(0, false);
        // startAuto(); // Disable auto slide based on user request
    })();
    </script>

    <!-- Add script for active link highlighting -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-item');

            // Highlight active section on scroll
            window.addEventListener('scroll', () => {
                let current = '';
                const scrollY = window.pageYOffset;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    // Add an offset so it highlights a bit before reaching the exact top
                    if (scrollY >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '/#' + current || link.getAttribute('href') === '#' + current) {
                        link.classList.add('active');
                    }
                });
            });

            // Initial call to set active state on page load
            window.dispatchEvent(new Event('scroll'));
        });
        
        // FAB & MODAL LOGIC
        function toggleFabMenu() {
            const menu = document.getElementById('fabMenu');
            menu.classList.toggle('active');
        }
        
        function openFaqModal() {
            document.getElementById('fabMenu').classList.remove('active');
            document.getElementById('faqModal').classList.add('active');
        }
        
        function closeFaqModal(e) {
            if (e && e.target !== e.currentTarget) return;
            document.getElementById('faqModal').classList.remove('active');
        }

        function openLaporanModal() {
            document.getElementById('fabMenu').classList.remove('active');
            document.getElementById('laporanModal').classList.add('active');
        }

        function closeLaporanModal(e) {
            if (e && e.target !== e.currentTarget) return;
            document.getElementById('laporanModal').classList.remove('active');
        }
        
        function toggleAccordion(btn) {
            const body = btn.nextElementSibling;
            const isOpen = btn.classList.contains('open');
            // Close all others
            document.querySelectorAll('.accordion-trigger.open').forEach(b => {
                b.classList.remove('open');
                b.nextElementSibling.classList.remove('open');
            });
            // Toggle clicked
            if (!isOpen) {
                btn.classList.add('open');
                body.classList.add('open');
            }
        }
        
        function switchTab(e, tabId) {
            document.querySelectorAll('.faq-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.faq-tab-content').forEach(c => c.classList.remove('active'));
            e.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
        
        // Tutup FAB menu jika klik di luar
        document.addEventListener('click', function(e) {
            const fabContainer = document.querySelector('.fab-container');
            if (fabContainer && !fabContainer.contains(e.target)) {
                document.getElementById('fabMenu').classList.remove('active');
            }
        });

        // =================== EVENT DETAIL MODAL ===================
        const _eventsData = JSON.parse(document.getElementById('eventsData').textContent);

        function openEventModal(id) {
            const ev = _eventsData.find(e => e.id === id);
            if (!ev) return;

            document.getElementById('edTitle').textContent = ev.title;
            document.getElementById('edDate').textContent = ev.event_date;
            document.getElementById('edQuota').textContent = ev.quota - ev.approved + ' sisa / ' + ev.quota;
            document.getElementById('edOrganizer').textContent = ev.organizer;
            document.getElementById('edLocation').textContent = ev.location;
            document.getElementById('edDescription').textContent = ev.description;

            const img = document.getElementById('edPosterImg');
            const placeholder = document.getElementById('edPosterPlaceholder');
            if (ev.poster) {
                img.src = ev.poster;
                img.style.display = 'block';
                placeholder.style.display = 'none';
            } else {
                img.style.display = 'none';
                placeholder.style.display = 'flex';
            }

            document.getElementById('eventDetailModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeEventModal(e) {
            if (e && e.target !== e.currentTarget) return;
            document.getElementById('eventDetailModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeEventModal();
        });
    </script>
</body>
</html>