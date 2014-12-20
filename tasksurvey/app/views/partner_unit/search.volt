
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("partner_unit/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("partner_unit/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Unit</th>
            <th>Partner</th>
            <th>Name</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for partner_unit in page.items %}
        <tr>
            <td>{{ partner_unit.unit_id }}</td>
            <td>{{ partner_unit.partner_id }}</td>
            <td>{{ partner_unit.name }}</td>
            <td>{{ link_to("partner_unit/edit/"~partner_unit.unit_id, "Edit") }}</td>
            <td>{{ link_to("partner_unit/delete/"~partner_unit.unit_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("partner_unit/search", "First") }}</td>
                        <td>{{ link_to("partner_unit/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("partner_unit/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("partner_unit/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
