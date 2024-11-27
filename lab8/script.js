document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("order-form");
    const citySelect = document.getElementById("city");
    const deliveryTypeSelect = document.getElementById("delivery_type");
    const branchSelect = document.getElementById("branch");

    // Завантаження міст
    function loadCities() {
        fetch("cities.php")
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

        fetch(`branches.php?city_id=${cityId}&delivery_type=${deliveryType}`)
            .then(response => response.json())
            .then(data => {
                const branches = data;
                branchSelect.innerHTML = '<option value="">Оберіть відділення/поштомат</option>'; // Очистити попередні варіанти
                branches.forEach(branch => {
                    const option = document.createElement("option");
                    option.value = branch.id;
                    option.textContent = branch.name;
                    branchSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Помилка завантаження відділень:', error));
    }

    // Зміна міста або типу доставки
    citySelect.addEventListener("change", (e) => {
        const cityId = e.target.value;
        const deliveryType = deliveryTypeSelect.value;
        loadBranches(cityId, deliveryType);
    });

    deliveryTypeSelect.addEventListener("change", () => {
        const cityId = citySelect.value;
        const deliveryType = deliveryTypeSelect.value;
        loadBranches(cityId, deliveryType);
    });

    // Відправка форми
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const orderData = {
            order_number: form.order_number.value,
            weight: parseFloat(form.weight.value),
            city: form.city.value,
            delivery_type: form.delivery_type.value,
            branch: form.branch.value
        };

        // Перевірка коректності введених даних
        if (!orderData.order_number || !orderData.weight || !orderData.city || !orderData.delivery_type || !orderData.branch) {
            alert("Будь ласка, заповніть усі поля.");
            return;
        }

        if (orderData.weight > 30 && orderData.delivery_type === 'postomat') {
            alert("Для вагою понад 30 кг, поштомат недоступний.");
            return;
        }

        // Відправка даних на сервер через AJAX
        fetch("save_order.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Помилка відправки замовлення:', error);
            alert("Сталася помилка при відправці замовлення.");
        });
    });

    // Завантаження міст при завантаженні сторінки
    loadCities();
});
