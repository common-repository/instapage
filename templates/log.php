<?php

/*
 * log.php is a template file. It's meant to be included in other php files. To work properly variables need to be set before file inclusion:
 *
 * @param string $currentDate Current date in readable format
 * @param array $rows Log entries as objects with properties:
 *  string $row->time - time of log entry creation in readable format
 *  string $row->name - name of the entry
 *  string $row->text - description of the entry
 *  string $row->caller - function that added the entry
 * @param string $pluginsHtml HTML containing a list of other installed plugins or modules
 * @param string $optionsHtml HTML containing options of the CMS
 * @param string $phpinfoHtml HTML containing phpinfo() output
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo InstapageCmsPluginConnector::escapeHTML(
        InstapageCmsPluginConnector::lang('Instapage Log') . ' ' . $currentDate
      ); ?></title>
    <style>
      body
      {
        background: #EFEFEF;
        font-family: "Courier New", "Courier", "Lucida Sans Typewriter", "Lucida Typewriter", "monospace";
        font-size: 12px;
      }

      h2
      {
        font-size: 28px;
        padding: 35px 0px;
      }

      table
      {
        border-collapse: collapse;
        width: 100%;
      }

      table,
      th,
      td
      {
           border: 1px solid #CECECE;
           cursor: pointer;
         }

         td,
         th
         {
        padding: 15px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 0;
         }

         td:hover {
        text-overflow: initial;
        white-space: pre-wrap;
        word-wrap: break-word;
        overflow: auto;
         }

         th
         {
           background: #7F7F7F;
           font-weight: bold;
           color: #EDEDED;
         }

         tr:nth-child(even)
      {
        background: #F7F7F7;
      }

      tr:hover
      {
        background: #FFF;
      }
      section h3 {
        margin-top: 50px;
      }
    </style>
  </head>
<body>
  <?php if (is_array($rows) && !empty($rows)): ?>
  <h2><?php echo InstapageCmsPluginConnector::lang('Log entries'); ?></h2>
  <table>
    <thead>
      <tr>
        <th width="2%"><?php echo InstapageCmsPluginConnector::lang('#'); ?></th>
        <th width="10%"><?php echo InstapageCmsPluginConnector::lang('Date'); ?></th>
        <th width="10%"><?php echo InstapageCmsPluginConnector::lang('Name'); ?></th>
        <th><?php echo InstapageCmsPluginConnector::lang('Text'); ?></th>
        <th width="15%"><?php echo InstapageCmsPluginConnector::lang('Caller'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $index => $row): ?>
        <tr>
          <td><?php echo InstapageCmsPluginConnector::escapeHTML($index + 1) ?></td>
          <td><?php echo InstapageCmsPluginConnector::escapeHTML($row->time); ?></td>
          <td><?php echo InstapageCmsPluginConnector::escapeHTML($row->name); ?></td>
          <td><?php echo InstapageCmsPluginConnector::escapeHTML($row->text); ?></td>
          <td><?php echo InstapageCmsPluginConnector::escapeHTML($row->caller); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
    <p><?php echo InstapageCmsPluginConnector::lang('Log is empty.'); ?></p>
  <?php endif; ?>
  <section class="db-structure">
    <h2><?php echo InstapageCmsPluginConnector::lang('Database structure'); ?></h2>
    <?php foreach ($dbStructure as $tableStructure): ?>
      <h3><?= InstapageCmsPluginConnector::escapeHTML($tableStructure['tableName']); ?></h3>
      <table>
        <tr>
          <th>Field name</th>
          <th>Field type</th>
          <th>Nullable?</th>
          <th>Key?</th>
          <th>Default value</th>
          <th>Extra info</th>
        </tr>
        <?php foreach ($tableStructure['description'] as $columnStructure):?>
          <tr>
            <td><?= InstapageCmsPluginConnector::escapeHTML($columnStructure->Field); ?></td>
            <td><?= InstapageCmsPluginConnector::escapeHTML($columnStructure->Type); ?></td>
            <td><?= InstapageCmsPluginConnector::escapeHTML($columnStructure->Null); ?></td>
            <td><?= InstapageCmsPluginConnector::escapeHTML($columnStructure->Key); ?></td>
            <td><?= InstapageCmsPluginConnector::escapeHTML($columnStructure->Default); ?></td>
            <td><?= InstapageCmsPluginConnector::escapeHTML($columnStructure->Extra); ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php endforeach; ?>
  </seciton>
  <h2><?php echo InstapageCmsPluginConnector::lang('Installed plugins'); ?></h2>
  <?php echo InstapageCmsPluginConnector::escapeHTML($pluginsHtml); ?>
  <h2><?php echo InstapageCmsPluginConnector::lang('CMS options'); ?></h2>
  <?php echo InstapageCmsPluginConnector::escapeHTML($optionsHtml); ?>
  <h2><?php echo InstapageCmsPluginConnector::lang('PHP Info'); ?></h2>
  <?php echo InstapageCmsPluginConnector::escapeHTML($phpinfoHtml); ?>
</body>
</html>
