
<p><?= $this->class ?></p>

<p><?= sprintf("%s:%d", $this->file, $this->line) ?></p>
<fieldset>
	<legend>backtrace</legend>

	<p><?= $this->message ? sprintf("code: (%d); message: %s", $this->code, $this->message) : "" ?></p>
	<pre><?= $this->trace ?></pre>

</fieldset>
