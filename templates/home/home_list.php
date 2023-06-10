<?php use Inter\Entity\Rate; ?>
<?php if (empty($allRates)): ?>
    Brak danych
<?php else: ?>
    <table border="solid">
        <thead>
            <tr>
                <th>Waluta</th>
                <th>Kod</th>
                <th>Kurs</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allRates as $rate): /** @var Rate $rate */ ?>
                <tr>
                    <td><?= $rate->getCurrency() ?></td>
                    <td><?= $rate->getCode() ?></td>
                    <td><?= $rate->getMid() ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>
