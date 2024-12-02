$(document).ready(function () {
    // Динамічне підвантаження пунктів доставки
    $('#city, #delivery_option').on('change', function () {
        const city = $('#city').val();
        const deliveryOption = $('#delivery_option').val();

        if (city && deliveryOption) {
            $.ajax({
                url: 'branches.php',
                type: 'POST',
                data: { city, delivery_option: deliveryOption },
                dataType: 'json',
                success: function (response) {
                    const deliveryPointSelect = $('#delivery_point');
                    deliveryPointSelect.empty().append('<option value="">Оберіть пункт</option>');

                    if (response.success && response.data.length > 0) {
                        response.data.forEach(point => {
                            deliveryPointSelect.append(`<option value="${point}">${point}</option>`);
                        });
                    } else {
                        deliveryPointSelect.append('<option value="">Немає доступних пунктів</option>');
                        alert(response.message || 'Немає доступних пунктів');
                    }
                },
                error: function () {
                    alert('Помилка завантаження пунктів доставки. Перевірте підключення.');
                }
            });
        }
    });

    // Відправка форми через AJAX
    $('#orderForm').on('submit', function (e) {
        e.preventDefault();

        const formData = {
            order_number: $('#order_number').val(),
            weight: $('#weight').val(),
            city: $('#city').val(),
            delivery_option: $('#delivery_option').val(),
            delivery_point: $('#delivery_point').val()
        };

        $.ajax({
            url: 'save_order.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.message) {
                    $('#responseMessage').text(response.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#responseMessage').text('Помилка при відправці даних: ' + textStatus);
                $('#responseMessage').css('color', 'red');
            }
        });
    });
});