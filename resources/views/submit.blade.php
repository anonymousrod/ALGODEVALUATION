<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GBSOLUX - Soumettre des Agences Immobilières</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2D6F32;
            --primary-light: #3d8f42;
            --accent: #9ACD32;
            --accent-light: #D5E5D6;
            --dark: #1a1a1a;
            --gray: #64748b;
            --light: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--dark) 0%, #2a2a2a 100%);
            color: white;
            min-height: 100vh;
        }

        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 30% 50%, rgba(157, 205, 50, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(45, 111, 50, 0.08) 0%, transparent 50%);
            animation: bgMove 20s ease-in-out infinite;
        }

        @keyframes bgMove {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-50px, -50px); }
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        header {
            text-align: center;
            margin-bottom: 3rem;
        }

        header h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 900;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fff 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        header p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: white;
        }

        input[type="checkbox"] {
            width: auto;
            margin-right: 0.5rem;
        }

        input, textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 20px rgba(157, 205, 50, 0.2);
        }

        input::placeholder, textarea::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .agency {
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            background: rgba(255, 255, 255, 0.02);
            transition: all 0.3s ease;
        }

        .agency:hover {
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.05);
        }

        .agency h3 {
            color: var(--accent);
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin: 2rem 0;
        }

        button {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--accent), var(--primary));
            border: none;
            border-radius: 50px;
            color: var(--dark);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(157, 205, 50, 0.3);
        }

        button:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 40px rgba(157, 205, 50, 0.5);
        }

        .add-agency-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: none;
        }

        .add-agency-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        .toast {
            display: none;
            padding: 1.5rem;
            margin-top: 2rem;
            border-radius: 15px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
            text-align: center;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .success {
            background: rgba(40, 167, 69, 0.2);
            color: #d4edda;
            border-color: rgba(40, 167, 69, 0.3);
        }

        .error {
            background: rgba(220, 53, 69, 0.2);
            color: #f8d7da;
            border-color: rgba(220, 53, 69, 0.3);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: white;
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .form-container {
                padding: 1.5rem;
            }

            .button-group {
                flex-direction: column;
            }

            button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>

    <div class="container">
        <a href="/" class="back-link">← Retour à l'accueil</a>

        <header>
            <h1>Soumettre des Agences Immobilières</h1>
            <p>Contribuez à enrichir notre base de données en soumettant des informations sur les agences immobilières. Toutes les soumissions sont vérifiées par nos administrateurs.</p>
        </header>

        <div class="form-container">
            <form id="submit-form">
        <div class="form-group">
            <label>
                <input type="checkbox" id="anonymous"> Soumettre en tant qu'anonyme
            </label>
        </div>
        <div id="user-fields">
            <div class="form-group">
                <label for="pseudo">Pseudo:</label>
                <input type="text" id="pseudo" name="pseudo" required>
            </div>
            <div class="form-group">
                <label for="phone">Numéro de téléphone:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
        </div>
        <div id="agencies">
            <div class="agency">
                <h3>Agence 1</h3>
                <div class="form-group">
                    <label for="agency-name-0">Nom de l'agence:</label>
                    <input type="text" id="agency-name-0" name="agencies[0][name]" required>
                </div>
                <div class="form-group">
                    <label for="agency-email-0">Email:</label>
                    <input type="email" id="agency-email-0" name="agencies[0][email]">
                </div>
                <div class="form-group">
                    <label for="agency-phone-0">Téléphone:</label>
                    <input type="tel" id="agency-phone-0" name="agencies[0][phone]">
                </div>
                <div class="form-group">
                    <label for="agency-siege-0">Siège:</label>
                    <textarea id="agency-siege-0" name="agencies[0][siege]"></textarea>
                </div>
            </div>
        </div>
                <div class="button-group">
                    <button type="button" id="add-agency" class="add-agency-btn">Ajouter une autre agence</button>
                    <button type="submit">Soumettre</button>
                </div>
            </form>
        </div>

        <div id="toast" class="toast"></div>
    </div>

    <script>
        let agencyCount = 1;

        document.getElementById('anonymous').addEventListener('change', function() {
            const userFields = document.getElementById('user-fields');
            const pseudo = document.getElementById('pseudo');
            const phone = document.getElementById('phone');
            if (this.checked) {
                userFields.style.display = 'none';
                pseudo.required = false;
                phone.required = false;
            } else {
                userFields.style.display = 'block';
                pseudo.required = true;
                phone.required = true;
            }
        });

        document.getElementById('add-agency').addEventListener('click', function() {
            const agenciesDiv = document.getElementById('agencies');
            const newAgency = document.createElement('div');
            newAgency.className = 'agency';
            newAgency.innerHTML = `
                <h3>Agence ${agencyCount + 1}</h3>
                <div class="form-group">
                    <label for="agency-name-${agencyCount}">Nom de l'agence:</label>
                    <input type="text" id="agency-name-${agencyCount}" name="agencies[${agencyCount}][name]" required>
                </div>
                <div class="form-group">
                    <label for="agency-email-${agencyCount}">Email:</label>
                    <input type="email" id="agency-email-${agencyCount}" name="agencies[${agencyCount}][email]">
                </div>
                <div class="form-group">
                    <label for="agency-phone-${agencyCount}">Téléphone:</label>
                    <input type="tel" id="agency-phone-${agencyCount}" name="agencies[${agencyCount}][phone]">
                </div>
                <div class="form-group">
                    <label for="agency-siege-${agencyCount}">Siège:</label>
                    <textarea id="agency-siege-${agencyCount}" name="agencies[${agencyCount}][siege]"></textarea>
                </div>
            `;
            agenciesDiv.appendChild(newAgency);
            agencyCount++;
        });

        document.getElementById('submit-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = {
                anonymous: document.getElementById('anonymous').checked,
                pseudo: formData.get('pseudo'),
                phone: formData.get('phone'),
                agencies: []
            };

            for (let i = 0; i < agencyCount; i++) {
                data.agencies.push({
                    name: formData.get(`agencies[${i}][name]`),
                    email: formData.get(`agencies[${i}][email]`),
                    phone: formData.get(`agencies[${i}][phone]`),
                    siege: formData.get(`agencies[${i}][siege]`)
                });
            }

            try {
                const response = await fetch('/api/submit', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const results = await response.json();
                const toast = document.getElementById('toast');
                if (response.ok) {
                    toast.className = 'toast success';
                    // Filter out the thank you message for display
                    const displayMessages = results.filter(r => r.status !== 'info').map(r => r.message).join('; ');
                    const thankYouMessage = results.find(r => r.status === 'info')?.message || '';
                    toast.textContent = 'Soumission réussie! ' + displayMessages + (thankYouMessage ? '\n\n' + thankYouMessage : '');
                } else {
                    toast.className = 'toast error';
                    toast.textContent = 'Erreur: ' + JSON.stringify(results);
                }
                toast.style.display = 'block';
            } catch (error) {
                document.getElementById('toast').textContent = 'Erreur réseau';
                document.getElementById('toast').className = 'toast error';
                document.getElementById('toast').style.display = 'block';
            }
        });
    </script>
</body>
</html>
