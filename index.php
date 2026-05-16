<?php include("includes/header.php"); ?>

<style>
/* Style pour l'arrière-plan en plein écran */
.hero-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    /* On injecte votre image Hyundai ici */
    background-image: url('https://galerie.automobile.tn/max/2024/01/porsche-911-carrera-2024-80349.webp');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    z-index: -2; /* Place l'image tout au fond */
}

/* Un voile sombre pour que votre texte reste parfaitement lisible */
.hero-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.55); /* 55% d'opacité noire */
    z-index: -1; /* Entre l'image et le texte */
}

/* Style pour centrer et styliser le texte */
.hero-content {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #ffffff; /* Texte en blanc */
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.hero-content p {
    font-size: 1.5rem;
    font-weight: 300;
}
</style>

<!-- 1. L'image d'arrière-plan -->
<div class="hero-background"></div>

<!-- 2. Le filtre sombre -->
<div class="hero-overlay"></div>

<!-- 3. Votre contenu textuel centré -->
<div class="container hero-content">
    <div>
        <h1>Bienvenue sur Car Rental</h1>
        <p>Réservez votre voiture facilement.</p>
    </div>
</div>

<?php include("includes/footer.php"); ?>