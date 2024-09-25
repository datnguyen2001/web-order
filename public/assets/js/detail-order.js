function fetchOrders(status) {
    $.ajax({
        url: `/get-order/${status}`,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if (data.data && data.data.length > 0) {
                renderOrders(data.data);
            } else {
                $('.box-list-order-user').html('<div class="no-data-message">Không có dữ liệu</div>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

const statusMapping = {
    1: 'Đã ký gửi',          // ACCEPTED
    2: 'Chờ duyệt',          // PENDING
    3: 'Người bán giao',     // MERCHANT_DELIVERING
    4: 'Hàng về kho trung quốc', // PUTAWAY
    5: 'Vận chuyển quốc tế',  // TRANSPORTING
    6: 'Chờ giao',           // READY_FOR_DELIVERY
    7: 'Đang giao',          // DELIVERING
    8: 'Đã nhận hàng',       // DELIVERED
    9: 'Đã hủy',             // CANCELLED
    10: 'Thất lạc',          // MIA
    11: 'Không nhận hàng'    // DELIVERY_CANCELLED
};

function renderOrders(orders) {
    const orderList = $('.box-list-order-user');
    orderList.empty();

    orders.forEach(order => {
        const orderCode = order.order_code || 'Đang cập nhật';
        const orderDate = order.created_at || 'N/A';

        const totalChinesePrice = order.order_items.reduce((total, item) => total + item.total_chinese_price, 0).toFixed(2);
        const totalVietnamesePrice = order.order_items.reduce((total, item) => total + item.total_vietnamese_price, 0);
        const totalQuantity = order.order_items.reduce((total, item) => total + item.quantity, 0);
        const orderStatus = statusMapping[order.status_id] || 'Đang cập nhật';

        let orderHtml = `
            <div class="content-item-order mb-2">
                <div class="line-status-shop">
                    <div class="order-code">Đơn hàng <span>${orderCode}</span></div>
                    <div class="line-date">${orderDate}</div>
                </div>
        `;

            orderHtml += `
                <div class="line-content-order">
                    <div class="name-product-order d-flex gap-2">
                        <div class="d-flex flex-column">
                            <div class="name-sp-item">Số lượng vận đơn: ${order.order_items.length}</div>
                            <div class="name-attr-product">Cần thanh toán: <span>${order.payment_type === 2 ?`¥${(order.total_payment_chinese - order.deposit_money).toLocaleString()}`:`${(order.total_payment_vietnamese - order.deposit_money).toLocaleString()}₫`}</span></div>
                        </div>
                    </div>
                    <div class="name-item-order d-flex flex-column align-items-end">
                        <div class="price-cq">¥${totalChinesePrice}</div>
                        <div class="price-vn">${totalVietnamesePrice.toLocaleString()}₫</div>
                    </div>
                    <div class="name-quantity-order price-cq">${totalQuantity}</div>
                    <div class="name-money-order d-flex flex-column align-items-end">
                        <div class="price-cq">¥${order.total_payment_chinese.toFixed(2)}</div>
                        <div class="price-vn">${order.total_payment_vietnamese.toLocaleString()}₫</div>
                        <div class="price-vn">Đã TT:  <span style="color: #3AA175;font-weight: 600">${order.payment_type === 2 ?'¥':''}${order.deposit_money.toLocaleString()}${order.payment_type === 1 ?'₫':''}</span></div>
                    </div>
                    <div class="name-status-order d-flex flex-column align-items-center">
                        <div class="status-order">${orderStatus}</div>
                        <a href="chi-tiet-don-hang/${order.id}" class="link-detail-order">Chi tiết</a>
                    </div>
                    <div class="name-work-order d-flex flex-column align-items-center">
                    ${order.status_id === 2 ?`<a href="cancel-order/${order.order_code}" class="status-order-pay">Hủy đơn</a>`:''}
                    </div>
                </div>
            `;

        orderHtml += `</div>`;
        orderList.append(orderHtml);
    });
}

$(document).ready(function () {
    fetchOrders('all');
});

let menuItems = document.querySelectorAll('.menu-item-order');
menuItems.forEach(item => {
    item.addEventListener('click', function() {
        menuItems.forEach(i => i.classList.remove('menu-item-order-active'));
        this.classList.add('menu-item-order-active');
        $('#orderCode').val('');
        $('#orderDate').val('');
        const status = this.getAttribute('data-status');
        fetchOrders(status);
    });
});

function searchOrders() {
    const formData = new FormData();
    const orderCode = $('#orderCode').val().trim();
    const orderDate = $('#orderDate').val();

    formData.append('order_code', orderCode);
    formData.append('order_date', orderDate);

    $.ajax({
        url: 'get-order/all',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            $('.menu-item-order').removeClass('menu-item-order-active');
            $('.menu-item-order[data-status="all"]').addClass('menu-item-order-active');
            if (data.data && data.data.length > 0) {
                renderOrders(data.data);
            } else {
                $('.box-list-order-user').html('<div class="no-data-message">Không có dữ liệu</div>');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
        }
    });
}
$('.btn-search-order').on('click', searchOrders);
