// ================= DADOS DE PRODUTOS ================= 
const products = [
    {
        id: 1,
        name: "Agenda Colorida",
        category: "Papelaria",
        price: 45.90,
        icon: {
            innerHTML: "<img src='papelaria/cardeno2.jpg' alt='Agenda Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Agenda personalizada com cores pasteis"
    },
    {
        id: 2,
        name: "Garrafinha Térmica",
        category: "Utensílios",
        price: 89.90,
        icon: {
            innerHTML: "<img src='ultilidade/ultilidade8.jpg' alt='Garrafinha Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Garrafa personalizada para manter bebida quentinha"
    },
    {
        id: 3,
        name: "Chaveiro Acrílico",
        category: "Acessórios",
        price: 24.90,
        icon: {
            innerHTML: "<img src='img/chaveiro1.jpg' alt='Chaveiro Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Chaveiro personalizado em acrílico"
    },
    {
        id: 4,
        name: "Caneca Especial",
        category: "Utensílios",
        price: 34.90,
        icon: {
            innerHTML: "<img src='img/canecas3.jpg' alt='Caneca Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Caneca personalizada para presentes"
    },
    {
        id: 5,
        name: "Kit Maternidade",
        category: "Festa",
        price: 159.90,
        icon: {
            innerHTML: "<img src='img/kitmaternidade1.jpg' alt='Kit Maternidade Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Kit completo para chá de fraldas"
    },
    {
        id: 6,
        name: "Topo de Bolo",
        category: "Festa",
        price: 29.90,
        icon: {
            innerHTML: "<img src='img/topobolo4.jpg' alt='Topo de Bolo Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Topo de bolo personalizado para sua festa"
    },
    {
        id: 7,
        name: "Decoração de Mesa",
        category: "Decoração",
        price: 69.90,
        icon: {
            innerHTML: "<img src='img/decoracaomesa2.jpg' alt='Decoração de Mesa Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Decoração de mesa personalizada"
    },
    {
        id: 8,
        name: "Tabuada Personalizada",
        category: "Papelaria",
        price: 99.90,
        icon: {
            innerHTML: "<img src='img/papelaria/tabuada.jpg' alt='Planner Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Tabuada personalizada para facilitar o aprendizado"
    },
    {
        id: 9,
        name: "Kits Lembrancinhas",
        category: "Festa",
        price: 249.90,
        icon: {
            innerHTML: "<img src='img/festa/kit_lembrancinha9.jpg' alt='Kits de Lembrancinhas Icon' style='width: 200px; height: 225px;'>"
        },
        description: "Kit de lembrancinhas personalizadas para sua festa"
    }
];

let cart = [];

// ================= MENU MÓVEL ================= 
const menuToggle = document.getElementById("menuToggle");
const navMenu = document.getElementById("navMenu");

menuToggle?.addEventListener("click", () => {
    menuToggle.classList.toggle("active");
    navMenu.classList.toggle("active");
});

// Fechar menu ao clicar em um link
document.querySelectorAll(".nav-link").forEach(link => {
    link.addEventListener("click", () => {
        menuToggle.classList.remove("active");
        navMenu.classList.remove("active");
    });
});

// ================= RENDERIZAR PRODUTOS ================= 
function renderProducts() {
    const productGrid = document.getElementById("productGrid");
    
    productGrid.innerHTML = products.map(product =>
        `
        <div class="product-card">
            <div class="product-image">
                ${product.icon.innerHTML}
            </div>
            <div class="product-info">
                <span class="product-category">${product.category}</span>
                <h3 class="product-name">${product.name}</h3>
                <p class="product-description">${product.description}</p>
                <p class="product-price">R$ ${product.price.toFixed(2)}</p>
                <button class="add-to-cart" onclick="addToCart(${product.id})">
                    Adicionar ao Carrinho
                </button>
            </div>
        </div>
    `).join("");
}

// ================= CARRINHO DE COMPRAS ================= 
const cartBtn = document.getElementById("cartBtn");
const cartModal = document.getElementById("cartModal");

cartBtn.addEventListener("click", openCart);

function openCart() {
    cartModal.style.display = "block";
    updateCartDisplay();
}

function closeCart() {
    cartModal.style.display = "none";
}

window.addEventListener("click", (e) => {
    if (e.target === cartModal) {
        closeCart();
    }
});

function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({
            ...product,
            quantity: 1
        });
    }

    updateCartCount();
    showNotification(`${product.name} adicionado ao carrinho!`);
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCartDisplay();
    updateCartCount();
}

function updateCartCount() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById("cartCount").textContent = totalItems;
}

function updateCartDisplay() {
    const cartItems = document.getElementById("cartItems");
    const cartTotal = document.getElementById("cartTotal");

    if (cart.length === 0) {
        cartItems.innerHTML = "<p style='text-align: center; color: #666; padding: 2rem;'>Seu carrinho está vazio</p>";
        cartTotal.textContent = "0.00";
        return;
    }

    let total = 0;
    cartItems.innerHTML = cart.map(item => {
        const subtotal = item.price * item.quantity;
        total += subtotal;
        return `
            <div class="cart-item">
                <div>
                    <h4>${item.name}</h4>
                    <p>Quantidade: ${item.quantity}</p>
                    <p>R$ ${(item.price * item.quantity).toFixed(2)}</p>
                </div>
                <button onclick="removeFromCart(${item.id})" style="
                    background: none;
                    border: none;
                    color: #999;
                    cursor: pointer;
                    font-size: 1.5rem;
                    transition: 0.3s;
                " onmouseover="this.style.color='#d32f2f'" onmouseout="this.style.color='#999'">
                    ✕
                </button>
            </div>
        `;
    }).join("");

    cartTotal.textContent = total.toFixed(2);
}

// ================= NOTIFICAÇÕES ================= 
function showNotification(message) {
    const notification = document.createElement("div");
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: linear-gradient(135deg, var(--pastel-pink) 0%, var(--pastel-peach) 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        animation: slideIn 0.3s ease;
        font-weight: bold;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = "slideOut 0.3s ease";
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Adicionar animações de notificação
const style = document.createElement("style");
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }

    @media (max-width: 480px) {
        .notification {
            right: 10px !important;
            left: 10px !important;
        }
    }
`;
document.head.appendChild(style);

// ================= CHECKOUT ================= 
document.querySelector(".checkout-btn").addEventListener("click", () => {
    if (cart.length === 0) {
        alert("Adicione itens ao carrinho primeiro!");
        return;
    }

    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const message = encodeURIComponent(
        `Olá! Gostaria de comprar:\n${cart.map(item => 
            `• ${item.name} (x${item.quantity}) - R$ ${(item.price * item.quantity).toFixed(2)}`
        ).join("\n")}\n\nTotal: R$ ${total.toFixed(2)}`
    );

    window.open(`https://wa.me/551300000000?text=${message}`, "_blank");
});

// ================= SCROLL SUAVE ================= 
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            document.querySelector(href).scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// ================= AUTENTICAÇÃO (LOGIN E CADASTRO) ================= 
const loginBtn = document.getElementById("loginBtn");
const signupBtn = document.getElementById("signupBtn");
const loginModal = document.getElementById("loginModal");
const signupModal = document.getElementById("signupModal");

// Abrir modal de login
loginBtn?.addEventListener("click", openLogin);

function openLogin() {
    loginModal.style.display = "block";
}

function closeLogin() {
    loginModal.style.display = "none";
}

// Abrir modal de cadastro
signupBtn?.addEventListener("click", openSignup);

function openSignup() {
    signupModal.style.display = "block";
}

function closeSignup() {
    signupModal.style.display = "none";
}

// Alternar entre login e cadastro
function switchToSignup() {
    closeLogin();
    openSignup();
}

function switchToLogin() {
    closeSignup();
    openLogin();
}

// Fechar modais ao clicar fora
window.addEventListener("click", (e) => {
    if (e.target === loginModal) {
        closeLogin();
    }
    if (e.target === signupModal) {
        closeSignup();
    }
});

// Lidar com envio do formulário de login
function handleLogin(event) {
    event.preventDefault();
    
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;
    
    // Validar campos
    if (!email || !password) {
        alert("Por favor, preencha todos os campos!");
        return;
    }
    
    // Simular login (em produção, enviar para servidor)
    const storedUser = localStorage.getItem(email);
    if (!storedUser) {
        alert("Usuário não encontrado! Faça o cadastro primeiro.");
        return;
    }
    
    const user = JSON.parse(storedUser);
    if (user.password !== password) {
        alert("Senha incorreta!");
        return;
    }
    
    // Login bem-sucedido
    localStorage.setItem("currentUser", JSON.stringify({
        name: user.name,
        email: user.email
    }));
    
    showNotification(`Bem-vindo, ${user.name}! 👋`);
    closeLogin();
    updateAuthButtonsUI();
    
    // Limpar formulário
    document.querySelector(".auth-form").reset();
}

// Lidar com envio do formulário de cadastro
function handleSignup(event) {
    event.preventDefault();
    
    const name = document.getElementById("signupName").value;
    const email = document.getElementById("signupEmail").value;
    const password = document.getElementById("signupPassword").value;
    const confirmPassword = document.getElementById("signupConfirmPassword").value;
    
    // Validar campos
    if (!name || !email || !password || !confirmPassword) {
        alert("Por favor, preencha todos os campos!");
        return;
    }
    
    // Validar senhas
    if (password !== confirmPassword) {
        alert("As senhas não conferem!");
        return;
    }
    
    if (password.length < 6) {
        alert("A senha deve ter pelo menos 6 caracteres!");
        return;
    }
    
    // Verificar se usuário já existe
    if (localStorage.getItem(email)) {
        alert("Este email já está cadastrado! Faça o login.");
        return;
    }
    
    // Salvar novo usuário
    localStorage.setItem(email, JSON.stringify({
        name: name,
        email: email,
        password: password
    }));
    
    showNotification(`Conta criada com sucesso, ${name}! 🎉`);
    closeSignup();
    
    // Fazer login automático
    localStorage.setItem("currentUser", JSON.stringify({
        name: name,
        email: email
    }));
    
    updateAuthButtonsUI();
    
    // Limpar formulário
    document.querySelector(".auth-form").reset();
}

// Atualizar UI dos botões de autenticação
function updateAuthButtonsUI() {
    const currentUser = localStorage.getItem("currentUser");
    
    if (currentUser) {
        const user = JSON.parse(currentUser);
        
        // Remover botões antigos se existirem
        document.getElementById("logoutBtn")?.remove();
        
        // Criar botão de logout
        const logoutBtn = document.createElement("button");
        logoutBtn.id = "logoutBtn";
        logoutBtn.className = "auth-btn logout-btn";
        logoutBtn.innerHTML = ` Sair`;
        logoutBtn.addEventListener("click", logout);
        
        // Modificar botão de login
        loginBtn.innerHTML = `👤 ${user.name.split(" ")[0]}`;
        loginBtn.style.pointerEvents = "none";
        loginBtn.style.opacity = "0.8";
        loginBtn.style.cursor = "default";
        
        // Esconder botão de cadastro
        signupBtn.style.display = "none";
        
        // Adicionar botão de logout após o botão de login
        loginBtn.parentNode.insertBefore(logoutBtn, loginBtn.nextSibling);
    } else {
        // Remover botão de logout se existir
        document.getElementById("logoutBtn")?.remove();
        
        // Mostrar botões de login e cadastro
        loginBtn.innerHTML = `Login`;
        loginBtn.style.pointerEvents = "auto";
        loginBtn.style.opacity = "1";
        loginBtn.style.cursor = "pointer";
        signupBtn.style.display = "block";
    }
}

// Função de logout
function logout() {
    const user = localStorage.getItem("currentUser");
    if (user) {
        const userData = JSON.parse(user);
        showNotification(`Até logo, ${userData.name}! 👋`);
    }
    
    localStorage.removeItem("currentUser");
    updateAuthButtonsUI();
    
    // Fechar o menu mobile se estiver aberto
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");
    if (menuToggle && navMenu) {
        menuToggle.classList.remove("active");
        navMenu.classList.remove("active");
    }
}

// ================= INICIALIZAÇÃO ================= 
document.addEventListener("DOMContentLoaded", () => {
    renderProducts();
    updateCartCount();
    updateAuthButtonsUI();
});
 
 
 
 