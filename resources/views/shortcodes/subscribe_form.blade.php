<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UnifyAMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    
    :root {
   
        --accent-yellow: #FACC15; 
        --white: #FFFFFF; 
        --gray-light: #C0C0C0;
        --primary-dark: #1E293B; 

        --card-background: #232B39; 
        --input-background: #2D3544; 
    } 
    
   
    .subscription-form-container { 
        display: flex; 
        flex-direction: column; 
        gap: 1.5rem; 
        max-width: 400px;
        width: 100%;
        padding: 5rem;
        background-color: var(--card-background); 
        border-radius: 1rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    } 

    .form-input { 
        width: 100%; 
        padding: 1.25rem 0.60rem; 
        border-radius: 0.5rem; 
        font-size: 1.125rem; 
        color: var(--white); 
        background-color: var(--input-background); 
        border: 1px solid transparent; 
        transition: border-color 0.3s, box-shadow 0.3s; 
    } 
    .form-input::placeholder {
        color: var(--gray-light);
        opacity: 0.8;
    }
    .form-input:focus { 
        border-color: var(--accent-yellow); 
        box-shadow: 0 0 0 1px var(--accent-yellow);
    } 
    
 
    .cta-button { 
        background-color: var(--accent-yellow); 
        color: var(--primary-dark); 
        font-weight: 700; 
        padding: 1rem 3.5rem; 
        border-radius: 0.5rem; 
        font-size: 1.25rem; 
        box-shadow: 0 8px 20px rgba(250, 204, 21, 0.5); 
        transition: background-color 0.3s, transform 0.3s; 
        border: none; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 0.5rem; 
        cursor: pointer;
    } 
    .cta-button:hover { 
        background-color: #FCD34D; 
        transform: translateY(-1px);
    } 
    .cta-icon { 
        width: 1.25rem; 
        height: 1.25rem; 
    }

 
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }
</style>

<form id="subscribe-form" class="subscription-form-container" action="/subscribe" method="POST">
 
    <input type="text" name="bot-check" style="display:none;" tabindex="-1">

    <label for="input-name" class="sr-only">Name</label>
    <input 
        type="text" 
        id="input-name" 
        name="name"
        placeholder="Name" 
        class="form-input" 
        required
        aria-label="Your Name"
    >

    <label for="input-email" class="sr-only">Email</label>
    <input 
        type="email" 
        id="input-email" 
        name="email"
        placeholder="Email" 
        class="form-input" 
        required
        aria-label="Your Email Address"
    >

    <button type="submit" class="cta-button">
        Send 
        <svg class="cta-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
    </button>
</form>