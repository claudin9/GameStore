<!-- Checkout Header -->
<div class="checkout-header">
    <div class="container">
        <h1 class="page-title">Finalizar Compra</h1>
    </div>
</div>

<!-- Checkout Content -->
<div class="checkout-content">
    <div class="container">
        <div class="checkout-layout">
            <!-- Checkout Form -->
            <div class="checkout-form">
                <form action="/gamestore/carrinho/finalizar" method="POST" id="checkoutForm">
                    <!-- Shipping Information -->
                    <section class="checkout-section">
                        <h2>Informações de Entrega</h2>
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input type="text" name="shipping_name" value="<?= $user['name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" name="shipping_cpf" value="<?= $user['cpf'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="tel" name="shipping_phone" value="<?= $user['phone'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>CEP</label>
                            <input type="text" name="shipping_zipcode" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Endereço</label>
                                <input type="text" name="shipping_address" required>
                            </div>
                            <div class="form-group">
                                <label>Número</label>
                                <input type="text" name="shipping_number" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Complemento</label>
                                <input type="text" name="shipping_complement">
                            </div>
                            <div class="form-group">
                                <label>Bairro</label>
                                <input type="text" name="shipping_neighborhood" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Cidade</label>
                                <input type="text" name="shipping_city" required>
                            </div>
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="shipping_state" required>
                                    <option value="">Selecione</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>
                    </section>

                    <!-- Payment Information -->
                    <section class="checkout-section">
                        <h2>Informações de Pagamento</h2>
                        <div class="form-group">
                            <label>Forma de Pagamento</label>
                            <div class="payment-methods">
                                <div class="payment-method">
                                    <input type="radio" name="payment_method" value="credit_card" id="credit_card" checked>
                                    <label for="credit_card">
                                        <i class="fas fa-credit-card"></i>
                                        Cartão de Crédito
                                    </label>
                                </div>
                                <div class="payment-method">
                                    <input type="radio" name="payment_method" value="pix" id="pix">
                                    <label for="pix">
                                        <i class="fas fa-qrcode"></i>
                                        PIX
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="creditCardFields">
                            <div class="form-group">
                                <label>Número do Cartão</label>
                                <input type="text" name="card_number" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Validade</label>
                                    <input type="text" name="card_expiry" placeholder="MM/AA">
                                </div>
                                <div class="form-group">
                                    <label>CVV</label>
                                    <input type="text" name="card_cvv" placeholder="123">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nome no Cartão</label>
                                <input type="text" name="card_name">
                            </div>
                            <div class="form-group">
                                <label>Parcelas</label>
                                <select name="installments">
                                    <option value="1">1x de R$ <?= number_format($total, 2, ',', '.') ?></option>
                                    <option value="2">2x de R$ <?= number_format($total/2, 2, ',', '.') ?></option>
                                    <option value="3">3x de R$ <?= number_format($total/3, 2, ',', '.') ?></option>
                                    <option value="4">4x de R$ <?= number_format($total/4, 2, ',', '.') ?></option>
                                    <option value="5">5x de R$ <?= number_format($total/5, 2, ',', '.') ?></option>
                                    <option value="6">6x de R$ <?= number_format($total/6, 2, ',', '.') ?></option>
                                </select>
                            </div>
                        </div>

                        <div id="pixFields" style="display: none;">
                            <div class="pix-info">
                                <p>Após finalizar o pedido, você receberá o código PIX para pagamento.</p>
                                <p>O pedido será processado após a confirmação do pagamento.</p>
                            </div>
                        </div>
                    </section>

                    <!-- Order Summary -->
                    <section class="checkout-section">
                        <h2>Resumo do Pedido</h2>
                        <div class="order-items">
                            <?php foreach ($cartItems as $item): ?>
                                <div class="order-item">
                                    <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>">
                                    <div class="item-info">
                                        <h3><?= $item['name'] ?></h3>
                                        <p>Quantidade: <?= $item['quantity'] ?></p>
                                        <p>R$ <?= number_format($item['price'] * $item['quantity'], 2, ',', '.') ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="order-totals">
                            <div class="total-item">
                                <span>Subtotal</span>
                                <span>R$ <?= number_format($total, 2, ',', '.') ?></span>
                            </div>
                            <div class="total-item">
                                <span>Frete</span>
                                <span>Calculado no final</span>
                            </div>
                            <div class="total-item total">
                                <span>Total</span>
                                <span>R$ <?= number_format($total, 2, ',', '.') ?></span>
                            </div>
                        </div>
                    </section>

                    <div class="checkout-actions">
                        <a href="/gamestore/carrinho" class="btn btn-outline">Voltar ao Carrinho</a>
                        <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const creditCardFields = document.getElementById('creditCardFields');
    const pixFields = document.getElementById('pixFields');
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');

    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            if (this.value === 'credit_card') {
                creditCardFields.style.display = 'block';
                pixFields.style.display = 'none';
            } else {
                creditCardFields.style.display = 'none';
                pixFields.style.display = 'block';
            }
        });
    });

    // Máscaras para os campos
    const masks = {
        cpf: '###.###.###-##',
        phone: '(##) #####-####',
        zipcode: '#####-###',
        cardNumber: '#### #### #### ####',
        cardExpiry: '##/##',
        cardCvv: '###'
    };

    Object.keys(masks).forEach(field => {
        const input = document.querySelector(`input[name="${field}"]`);
        if (input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                let result = '';
                let mask = masks[field];

                for (let i = 0, j = 0; i < mask.length && j < value.length; i++) {
                    if (mask[i] === '#') {
                        result += value[j];
                        j++;
                    } else {
                        result += mask[i];
                    }
                }

                e.target.value = result;
            });
        }
    });
});
</script> 