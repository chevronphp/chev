<h2><?= $this->class ?></h2>
<h2><?= sprintf("(%d), %s", $this->code, $this->message) ?></h2>
<h2><?= sprintf("(%d), %s", $this->line, $this->file) ?></h2>
<pre><?= $this->trace ?></pre>
