<?php use Inter\Entity\Rate; ?>
<?php if (empty($allRates)) : ?>
    Brak danych
<?php else: ?>
    <form action="/convert/" method="post">
        Kwota (użyj kropki jako separatora dziesiętnego):
        <input type="number" min="0" name="amount" step=".01" />
        <br>

        Waluta źródłowa:
        <select name="from">
            <?php foreach ($allRates as $rate): /** @var Rate $rate */ ?>
                <option
                    value="<?= $rate->getId() ?>"
                    <?php if ($from?->getId() === $rate->getId()): ?>
                        selected
                    <?php endif ?>
                >
                    <?= $rate->getCurrency() ?> (<?= $rate->getCode() ?>)
                </option>
            <?php endforeach ?>
        </select>
        <br>

        Waluta docelowa:
        <select name="to">
            <?php foreach ($allRates as $rate): /** @var Rate $rate */ ?>
                <option
                    value="<?= $rate->getId() ?>"
                    <?php if ($to?->getId() === $rate->getId()): ?>
                        selected
                    <?php endif ?>
                >
                <?= $rate->getCurrency() ?> (<?= $rate->getCode() ?>)
            <?php endforeach ?>
        </select>
        <br>

        <button type="submit">Przelicz</button>
    </form>
<?php endif ?>
