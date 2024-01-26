import './bootstrap';

function updateCartDropdown(cart) {
    const cartDropdown = document.getElementById('cart-dropdown');
    const cartCount = document.getElementById('cart-count');
    const productContainer = cartDropdown.querySelector('.product-container');
    const cartTotal = document.getElementById('cart-total');

    productContainer.innerHTML = ''; // Limpiar el contenido
    let total = 0;

    Object.entries(cart).forEach(([productId, details]) => {
        const itemDiv = document.createElement('div');
        // Calcula el total
        total += details.quantity * details.price;

        itemDiv.classList.add('px-4', 'py-2', 'flex', 'items-center');
        itemDiv.innerHTML = `
            <img src="${details.image}" alt="${details.name}" class="h-10 w-10 object-cover mr-2"> <!-- Imagen del producto -->
            <div class="flex-grow">
                <span class="block text-sm">${details.name}</span>
                <span class="block text-sm text-gray-500">Cantidad: ${details.quantity}</span>
                <span class="block text-sm text-gray-500">Total: ${details.quantity * details.price}€</span>
            </div>
            <button class="remove-from-cart" data-product-id="${productId}">
                <i class="fas fa-trash-alt"></i>
            </button>
        `;
        productContainer.appendChild(itemDiv);
    });

    cartCount.textContent = Object.keys(cart).length;
    cartTotal.textContent = `${total.toFixed(2)}€`; // Actualizar el total

    // Agregar listeners a los botones de eliminar
     document.querySelectorAll('.remove-from-cart').forEach(button => {
        button.addEventListener('click', handleRemoveFromCart);
    });
   
}

function handleRemoveFromCart(e) {
    e.preventDefault();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const button = e.target.closest('.remove-from-cart');
    if (!button) {
        console.error('Botón de eliminar no encontrado');
        return;
    }
    const productId = button.getAttribute('data-product-id');
    console.log('Producto a eliminar:', productId);

    fetch(`/cart/remove/${productId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Producto eliminado, carrito actualizado:', data.cart);
        updateCartDropdown(data.cart);
    })
    .catch(error => console.error('Error:', error));
}


document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (window.cartData) {
        updateCartDropdown(window.cartData);
    }    const cartButton = document.getElementById('cart-button');
    const cartDropdown = document.getElementById('cart-dropdown');

    let isMouseOverDropdown = false;

    cartButton.addEventListener('mouseenter', function() {
        cartDropdown.classList.remove('hidden');
    });

    cartDropdown.addEventListener('mouseenter', function() {
        isMouseOverDropdown = true;
    });

    cartDropdown.addEventListener('mouseleave', function() {
        isMouseOverDropdown = false;
        cartDropdown.classList.add('hidden');
    });

    cartButton.addEventListener('mouseleave', function(event) {
        setTimeout(function() {
            if (!isMouseOverDropdown) {
                cartDropdown.classList.add('hidden');
            }
        }, 100); 
    });

    // Agregar listeners a los botones de eliminar
    document.querySelectorAll('.remove-from-cart').forEach(button => {
        button.addEventListener('click', handleRemoveFromCart);
    });

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const quantityInput = this.previousElementSibling.querySelector('.quantity-input');
            const quantity = quantityInput ? quantityInput.value : 1;
            const cartIcon = document.getElementById('cart-icon');
            
            cartIcon.classList.add('cart-animate');

            setTimeout(() => {
                cartIcon.classList.remove('cart-animate');
            }, 500);

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Aquí puedes actualizar el UI según los datos recibidos.
                updateCartDropdown(data.cart); // Asumiendo que 'cart' es parte de la respuesta JSON
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
                
            });
        });
    });
});