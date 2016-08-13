
<p><?= $this->eClass ?></p>

<p><?= sprintf("%s:%d", $this->eFile, $this->eLine) ?></p>
<fieldset>
	<legend>backtrace</legend>

	<p><?= $this->eMessage ? sprintf("code: (%d); message: %s", $this->eCode, $this->eMessage) : "" ?></p>
	<pre><?= $this->eTrace ?></pre>

</fieldset>
