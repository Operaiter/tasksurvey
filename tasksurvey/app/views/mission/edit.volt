{{ content() }}
{{ form("mission/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("mission", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit mission</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="time">Time</label>
        </td>
        <td align="left">
            {{ text_field("time", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="active">Active</label>
        </td>
        <td align="left">
            {{ text_field("active", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="time_change">Time Of Change</label>
        </td>
        <td align="left">
            {{ text_field("time_change", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
