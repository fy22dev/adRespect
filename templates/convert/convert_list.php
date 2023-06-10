<?php use Inter\Entity\Convert; ?>
<?php if (empty($allConverts)): ?>
    Brak danych
<?php else: ?>
    <table border="solid">
        <thead>
            <tr>
                <th>Waluta źródłowa</th>
                <th>Waluta docelowa</th>
                <th>Końcowa kwota</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allConverts as $convert): /** @var Convert $convert */?>
                <tr>
                    <td><?= sprintf('%s (%s)', $convert->getFrom()->getCurrency(), $convert->getFrom()->getCode()) ?></td>
                    <td><?= sprintf('%s (%s)', $convert->getTo()->getCurrency(), $convert->getTo()->getCode()) ?></td>
                    <td><?= sprintf('%s', $convert->getAmount()) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>