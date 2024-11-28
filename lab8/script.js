document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("order-form");
    const citySelect = document.getElementById("city");
    const deliveryTypeSelect = document.getElementById("delivery_type");
    const branchSelect = document.getElementById("branch");

    const API_KEY = 'bb0bb452005d70efbacfcc354b9c74e4'; //API ключ

    // Завантаження міст
    function loadCities() {
        fetch("cities.php", {
            method: "GET",
            headers: {
                "X-API-KEY": API_KEY // Додаємо API ключ до заголовка
            }
        })
        .then(response => response.json())
        .then(data => {
            const cities = data;
            cities.forEach(city => {
                const option = document.createElement("option");
                option.value = city.id;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        })
        .catch(error => console.error('Помилка завантаження міст:', error));
    }

    // Завантаження відділень/поштоматів
    function loadBranches(cityId, deliveryType) {
        if (!cityId || !deliveryType) return;

        fetch(`branches.php?city_id=${cityId}&delivery_type=${deliveryType}`, {
            method: "GET",
            headers: {
                "X-API-KEY": API_KEY // Додаємо API ключ до заголовка
            }
        })
        .then(response => response.json())
        .then(data => {
            branchSelect.innerHTML = '<option value="">Оберіть відділення/поштомат</option>';
            data.forEach(branch => {
                const option = document.createElement("option");
                option.value = branch.id;
                option.textContent = branch.name;
                branchSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Помилка завантаження відділень:', error));
    }

    // Відправка форми
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(form);
        const orderData = {
            order_number: formData.get("order_number"),
            weight: formData.get("weight"),
            city: formData.get("city"),
            delivery_type: formData.get("delivery_type"),
            branch: formData.get("branch")
        };

        fetch('save_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                "X-API-KEY": API_KEY // Додаємо API ключ до заголовка
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(error => console.error('Помилка збереження замовлення:', error));
    });

    loadCities();

    citySelect.addEventListener('change', function() {
        const cityId = this.value;
        const deliveryType = deliveryTypeSelect.value;
        loadBranches(cityId, deliveryType);
    });

    deliveryTypeSelect.addEventListener('change', function() {
        const cityId = citySelect.value;
        const deliveryType = this.value;
        loadBranches(cityId, deliveryType);
    });
});
