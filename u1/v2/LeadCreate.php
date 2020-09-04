{% extends 'sales/base.html' %}
{% load staticfiles %}
{% load paginate %}
{% load thumbnail %}
{% block extralinks %}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
  .form-group label {
    font-weight: 800;
  }

  .add_opacity {
    opacity: 0.2;
  }

  .opacity_block {
    opacity: 0.2;
  }
</style>
{% endblock %}
{% block content %}
<!-- main_container starts here -->
<div class="main_container">
  <!-- heading_create starts here -->
  <div class="row marl">
    <div class="col-lg-12 text-right">
      <span class="d-inline"><a class="primary_btn btn-info edit" data-toggle="modal" data-target="#uploadleadfile"
          href="#"><i class="fas fa-upload"></i>Upload Lead csv file</a></span>
      <span class="d-inline"><a class="primary_btn" href="{% url 'leads:add_lead'%}"><i class="fa fa-plus"></i> Add New
          Lead</a></span>
    </div>
  </div>
  <!-- heading_create ends here -->
  <div class="filter_row list_filter_row row marl" id="opacity_block">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <form id="leads_filter" action="" method="POST">
            <div class="card-body ">
              <div class="card-title">Filters</div>
              <div class="row marl">
                <div class="filter_col col-md-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="name"
                      value="{{request.POST.name}}">
                  </div>
                </div>
                <div class="filter_col col-md-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Source</label>
                    <select class="form-control" id="id_source" name="source">
                      <option value="">--Source of Lead--</option>
                      {% for each_source in source %}
                      <option value="{{each_source.0}}" {% if request.POST.source %}
                        {% ifequal each_source.0 request.POST.source %}selected{% endifequal %}{% endif %}>
                        {{each_source.1}} </option>
                      {% endfor %}
                    </select>
                  </div>
                </div>
                <div class="filter_col col-md-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Assigned Users</label>
                    <select class="assigned_users form-control" name="assigned_to" multiple="multiple">
                      {% for user in users %}
                      <option value="{{user.id}}" {% if user.id in assignedto_list %} selected="" {% endif %}>
                        {{user.email}}</option>
                      {% endfor %}
                    </select>
                  </div>
                </div>
                <div class="filter_col col-md-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" id="id_status" name="status">
                      <option value="">--Status of Lead--</option>
                      {% for each_status in status %}
                      <option value="{{each_status.0}}" {% if request.POST.status %}
                        {% ifequal each_status.0 request.POST.status %}selected{% endifequal %}{% endif %}>
                        {{each_status.1}} </option>
                      {% endfor%}
                    </select>
                  </div>
                </div>
                <div class="filter_col col-md-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tags</label>
                    <select class="form-control" id="id_tag" name="tag" multiple>
                      <!-- <option value="">--Select Tags--</option> -->
                      {% for tag in tags %}
                      <option value="{{tag.id}}" {% if request_tags %}
                        {% if tag.id|slugify in request_tags %}selected{% endif %}{% endif %}>{{ tag.name }} </option>
                      {% endfor%}
                    </select>
                  </div>
                </div>
                <input type="hidden" name="tab_status" id="tab_status">
                <div class="filter_col col-2">
                  <div class="form-group buttons_row">
                    <button class="btn btn-primary save" type="submit">Search</button>
                    <a href="{% url 'leads:list' %}" class="btn btn-default clear">Clear</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12 col-xl-12">
    <div class="table_container_row row marl no-gutters">
      <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="open-tab" data-toggle="tab" href="#open" role="tab" aria-controls="open"
              aria-selected="true">Open ({{open_leads|length}})</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="close-tab" data-toggle="tab" href="#close" role="tab" aria-controls="close"
              aria-selected="false">Closed ({{close_leads|length}})</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open">
            <div class="card">
              <div class="card-body">
                <div class="card-title text-right">
                  <span class="float-left">Open Leads - {% if show_pageitems %} {% show_pageitems %}{% else %}
                    {{ open_leads|length }}{% endif %}</span>
                  <span class="filter_toggle">
                    <a href="#" class="primary_btn"><i class="fas fa-filter"></i></a>
                  </span>
                </div>
                <div class="table-responsive">
                  <table class="table ">
                    <thead>
                      {% if open_leads|length > 0 %}
                      <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Title</th>
                        <th width="8%">Created By</th>
                        <th width="5%">Source</th>
                        <th width="5%">Status</th>
                        <th width="15%">Assigned To</th>
                        <th width="15%">Tags</th>
                        <th width="5%">Country </th>
                        <th width="10%">Created On</th>
                        <th width="10%">Actions</th>
                      </tr>
                      {% endif %}
                    </thead>
                    <tbody>
                      {% if per_page %}
                      {% paginate per_page open_leads %}
                      {% else %}
                      {% paginate 10 open_leads %}
                      {% endif %}
                      {% for lead in open_leads %}
                      <tr class="text-center">
                        <td scope="row">{{ forloop.counter }}</td>
                        <!-- <td><a href="{% url 'leads:view_lead' lead.id %}">
                            {{ lead.title }} </a></td> -->
                        <td>
                          <a data-toggle="modal" data-target="#exampleModalCenter_lead{{lead.id}}" href="#">
                            {{ lead.title }}
                          </a>
                        </td>
                        <td>
                          {% if lead.created_by %}
                          {% if lead.created_by.profile_pic %}
                          {% thumbnail lead.created_by.profile_pic "40x40" crop="center" as im %}
                          <a href="{% url 'common:view_user' user.id %}">
                            <img src="{{ im.url }}" width="{{ im.width }}" height="{{ im.height }}"
                              title="{{ lead.created_by }}">
                          </a>
                          {% endthumbnail %}
                          {% else %}
                          <a href="{% url 'common:view_user' user.id %}">
                            <img src="{% static 'images/user.png' %}" alt="Micro profile pic"
                              style="width: 40px;height: 40px;" title="{{ lead.created_by }}" />
                          </a>
                          {% endif %}
                          {% else %}
                          None
                          {% endif %}
                        </td>
                        <td>{{ lead.source }}</td>
                        <td>{{ lead.get_status_display }}</td>
                        <td>
                          {% with lead_users=lead.assigned_to.all %}
                          {% for user in lead_users %}
                          {% if user.profile_pic %}
                          {% thumbnail user.profile_pic "40x40" crop="center" as im %}
                          <a href="{% url 'common:view_user' user.id %}">
                            <img src="{{ im.url }}" width="{{ im.width }}" height="{{ im.height }}"
                              title="{{ user.email }}">
                          </a>
                          {% endthumbnail %}
                          {% else %}
                          <a href="{% url 'common:view_user' user.id %}">
                            <img src="{% static 'images/user.png' %}" title="{{ user.email }}" width="40" height="40">
                          </a>
                          {% endif %}
                          {% empty %}
                          None
                          {% endfor %}
                          {% endwith %}
                        </td>
                        <td>
                          <div class="tag_content" id="leadtag{{lead.id}}" data-leadTagContent="{{lead.id}}">
                            {% with tags=lead.tags.all %}
                            {% if tags %}
                            {% for tag in tags %}
                            <span style="cursor: pointer;" class="tag_class_lead_" data-leadTag="{{lead.id}}{{tag.id}}">
                              <span class="text-left color{{forloop.counter}}" id="list_tag">
                                <span data-link="{{tag.id}}" class="tag_class_lead">
                                  {{ tag.name }}
                                </span>
                                <span class="remove_tag" data-tag={{tag.id}} data-lead="{{lead.id}}"><i
                                    class="fas fa-times" style="color: rgb(255, 255, 255);"></i></span>
                              </span>
                            </span>
                            {% endfor %}
                            <!-- <span title="Update Tags" data-toggle="modal" data-target=".modal_tags{{lead.id}}"><i
                              class="fas fa-pencil-alt"></i></span> -->
                            {% else %}
                            No Tags
                            {% endif %}
                            {% endwith %}
                            <!-- <span class="ml-2" title="Update Tags" data-toggle="modal"
                              data-target=".modal_tags{{lead.id}}"><i class="fas fa-plus"></i></span> -->
                          </div>
                        </td>
                        <td>{{ lead.country }}</td>
                        <td title="{{ lead.created_on }}">{{ lead.created_on_arrow }}</td>
                        <td class="actions">
                          <a href="{% url 'leads:view_lead' lead.id %}" class="btn btn-info edit"><i
                              class="fas fa-eye"></i></a>
                          <a href="{% url 'leads:edit_lead' lead.id %}" class="btn btn-success edit"><i
                              class="fas fa-pencil-alt"></i></a>
                          {% if request.user == lead.created_by or request.user.role == "ADMIN" or request.user.is_superuser %}
                          <a href="{% url 'leads:remove_lead' lead.id %}"
                            class="btn btn-danger delete remove_account"><i class="fas fa-trash-alt"></i></a>
                          {% endif %}
                        </td>
                      </tr>
                      {% endfor %}
                    </tbody>
                  </table>
                </div>
                {%ifequal open_leads|length 0%}
                <h6 class="text-center">No Open Lead Records Found</h6>
                {%endifequal%}
                <div class="marl row text-center">
                  {% show_pages %}
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="close" role="tabpanel" aria-labelledby="close">
            <div class="card">
              <div class="card-body">
                <div class="card-title text-right">
                  <span class="float-left">Closed Leads - {% if show_pageitems %} {% show_pageitems %}{% else %}
                    {{ close_leads|length }}{% endif %}</span>
                  <span class="filter_toggle">
                    <a href="#" class="primary_btn"><i class="fas fa-filter"></i></a>
                  </span>
                </div>
                <div class="table-responsive">
                  <table class="table ">
                    <thead>
                      {% if close_leads|length > 0 %}
                      <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Title</th>
                        <th width="10%">Source</th>
                        <th width="5%">Status</th>
                        <th width="20%">Assigned User</th>
                        <th width="20%">Tags</th>
                        <th width="5%">Country</th>
                        <th width="15%">Created On</th>
                        <th width="10%">Actions</th>
                      </tr>
                      {% endif %}
                    </thead>
                    <tbody>
                      {% if per_page %}
                      {% paginate per_page close_leads %}
                      {% else %}
                      {% paginate 10 close_leads %}
                      {% endif %}
                      {% for lead in close_leads %}
                      <tr class="text-center">
                        <td scope="row">{{ forloop.counter }}</td>
                        <td><a href="#" data-toggle="modal" data-target="#exampleModalCenter_lead{{lead.id}}">
                            {{ lead.title }}</a></td>
                        <td>{{ lead.source }}</td>
                        <td>{{ lead.get_status_display }}</td>
                        <td>
                          {% with lead_users=lead.assigned_to.all %}
                          {% for user in lead_users %}
                          {% if user.profile_pic %}
                          {% thumbnail user.profile_pic "40x40" crop="center" as im %}
                          <a href="{% url 'common:view_user' user.id %}">
                            <img src="{{ im.url }}" width="{{ im.width }}" height="{{ im.height }}"
                              title="{{ user.email }}">
                          </a>
                          {% endthumbnail %}
                          {% else %}
                          <a href="{% url 'common:view_user' user.id %}">
                            <img src="{% static 'images/user.png' %}" title="{{ user.email }}" width="40" height="40">
                          </a>
                          {% endif %}
                          {% empty %}
                          None
                          {% endfor %}
                          {% endwith %}
                        </td>
                        <td>
                          <div class="tag_content" id="leadtag{{lead.id}}" data-leadTagContent="{{lead.id}}">
                            {% with tags=lead.tags.all %}
                            {% if tags %}
                            {% for tag in tags %}
                            <span style="cursor: pointer;" class="tag_class_lead_" data-leadTag="{{lead.id}}{{tag.id}}">
                              <span class="text-left color{{forloop.counter}}" id="list_tag">
                                <span data-link="{{tag.id}}" class="tag_class_lead">
                                  {{ tag.name }}
                                </span>
                                <span class="remove_tag" data-tag={{tag.id}} data-lead="{{lead.id}}"><i
                                    class="fas fa-times" style="color: rgb(255, 255, 255);"></i></span>
                              </span>
                            </span>
                            {% endfor %}
                            <!-- <span title="Update Tags" data-toggle="modal" data-target=".modal_tags{{lead.id}}"><i
                                  class="fas fa-pencil-alt"></i></span> -->
                            {% else %}
                            No Tags
                            {% endif %}
                            {% endwith %}
                            <!-- <span class="ml-2" title="Update Tags" data-toggle="modal"
                                  data-target=".modal_tags{{lead.id}}"><i class="fas fa-plus"></i></span> -->
                          </div>
                        </td>
                        <td>{{ lead.country }}</td>
                        <td title="{{ lead.created_on_arrow }}">{{ lead.created_on_arrow }}</td>
                        <td class="actions">
                          <a href="{% url 'leads:view_lead' lead.id %}" class="btn btn-info edit"><i
                              class="fas fa-eye"></i></a>
                          <a href="{% url 'leads:edit_lead' lead.id %}" class="btn btn-success edit"><i
                              class="fas fa-pencil-alt"></i></a>
                          {% if request.user == lead.created_by %}
                          <a href="{% url 'leads:remove_lead' lead.id %}"
                            class="btn btn-danger delete remove_account"><i class="fas fa-trash-alt"></i></a>
                          {% endif %}
                        </td>
                      </tr>
                      {% endfor %}
                    </tbody>
                  </table>
                </div>
                {%ifequal close_leads|length 0%}
                <h6 class="text-center">No Closed Lead Records Found</h6>
                {%endifequal%}
                <div class="marl row text-center">
                  {% show_pages %}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{% for lead_record in open_leads %}

{% comment %}
<!-- modal for editing and deleting tags -->

<div class="modal fade bd-example-modal-lg modal_tags{{lead_record.id}}" tabindex="-1" role="dialog"
  aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="padding:20px 50px;">
        <h4><span class="glyphicon glyphicon-lock"></span>Update Tags</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding:20px 50px;">
        <form role="form" id="" method="POST" action="{% url 'leads:update_lead_tags' lead_record.id %}">
          <div class="form-group">
            <label>Tags</label>
            <div class="txt-box-div" id="tag-div"><input type="text" name="tags" id="tags_1"
                value="{% for t in lead_record.tags.all %}{{t.name}}, {% endfor %}" class="tags tags_1" />
            </div>
          </div>
          <input type="hidden" name="full_path" value="{{request.get_full_path}}">
          <div class="text-center">
            <button id="" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal for editing and deleting tags -->
{% endcomment %}

<div class="modal fade" id="exampleModalCenter_lead{{lead_record.id}}" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{lead_record.title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- ... -->
        <div class=" ">
          <div class="col-md-12" id="">
            <div class="card">

              <div class="card-body" id="datashow" style="margin: 0; padding: 0;">
                <div class="card-title text-right">
                  <h5>
                    <!-- <span class="float-left title">Overview</span> -->
                    <span class="" style="margin-top: 0px">
                      <div class="dropdown buttons_row">
                        <!-- <button class="btn primary_btn dropdown-toggle" type="button" data-toggle="dropdown">Actions
                            <span class="caret"></span></button> -->

                      </div>
                    </span>
                  </h5>
                </div>
                <div class="row marl">
                  <div class="col-md-4">
                    <div class="filter_col col-md-12" id="iname">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_name" data-name="name">Name</label>
                        <div class="lead_field" id="lead_name" data-name="name"> {% if lead_record.first_name  %}
                          {{ lead_record.first_name }}{% endif %} {% if lead_record.last_name  %}
                          {{ lead_record.last_name }}{% endif %}</div>
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_contact_account" data-name="name">Account Name</label>
                        {% if lead_record.account_name %}
                        <div class="lead_field" id="contact_account" data-name="name">{{ lead_record.account_name }}
                        </div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_title" data-name="name">Title</label>
                        {% if lead_record.title %}
                        <div class="lead_field" id="lead_title" data-name="name">{{ lead_record.title }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_phone" data-name="name">Phone</label>
                        {% if lead_record.phone %}
                        <div class="lead_field" id="lead_phone" data-name="name">{{ lead_record.phone }}</div>
                        {% else %}
                        <div class="lead_field">Not specified</div>
                        {% endif %}
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_email" data-name="name">Email</label>
                        {% if lead_record.email %}
                        <div class="lead_field" id="lead_email" data-name="name">{{ lead_record.email }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_status" data-name="name">Status</label>
                        {% if lead_record.status %}
                        <div class="lead_field" id="lead_status" data-name="name">{{ lead_record.status }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_source" data-name="name">Source</label>
                        {% if lead_record.source %}
                        <div class="lead_field" id="lead_source" data-name="name">{{ lead_record.source }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_website" data-name="name">Website</label>
                        {% if lead_record.website %}
                        <div class="lead_field" id="lead_website" data-name="name">{{ lead_record.website }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">

                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        {% if lead_record.address_line or lead_record.street or lead_record.city or lead_record.state or lead_record.postcode or lead_record.country %}
                        <label class="lead_field_label" for="id_address" data-name="name">Billing Address</label>
                        <div class="lead_field" id="lead_address" data-name="name">
                          {{lead_record.get_complete_address}}
                        </div>
                        {% endif %}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    {% if lead_record.description %}
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_description" data-name="name">Description</label>
                        <div class="lead_field" id="lead_description" data-name="name">{{ lead_record.description }}
                        </div>
                      </div>
                    </div>
                    {% endif %}
                    <div class="created_information">
                      Created by <b>{{ lead_record.created_by }}</b> created on <b
                        title="{{ lead_record.created_on }}">{{ lead_record.created_on_arrow }}</b>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
  </div>
</div>


{% endfor %}


{% for lead_record in close_leads %}


<!-- modal for editing and deleting tags -->

<div class="modal fade bd-example-modal-lg modal_tags{{lead_record.id}}" tabindex="-1" role="dialog"
  aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="padding:20px 50px;">
        <h4><span class="glyphicon glyphicon-lock"></span>Update Tags</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding:20px 50px;">
        <form role="form" id="" method="POST" action="{% url 'leads:update_lead_tags' lead_record.id %}">
          <div class="form-group">
            <label>Tags</label>
            <div class="txt-box-div" id="tag-div"><input type="text" name="tags" id="tags_1"
                value="{% for t in lead_record.tags.all %}{{t.name}}, {% endfor %}" class="tags tags_1" />
            </div>
          </div>
          <input type="hidden" name="full_path" value="{{request.get_full_path}}">
          <div class="text-center">
            <button id="" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal for editing and deleting tags -->


<div class="modal fade" id="exampleModalCenter_lead{{lead_record.id}}" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{lead_record.title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- ... -->
        <div class=" ">
          <div class="col-md-12" id="">
            <div class="card">

              <div class="card-body" id="datashow" style="margin: 0; padding: 0;">
                <div class="card-title text-right">
                  <h5>
                    <!-- <span class="float-left title">Overview</span> -->
                    <span class="" style="margin-top: 0px">
                      <div class="dropdown buttons_row">
                        <!-- <button class="btn primary_btn dropdown-toggle" type="button" data-toggle="dropdown">Actions
                            <span class="caret"></span></button> -->

                      </div>
                    </span>
                  </h5>
                </div>
                <div class="row marl">
                  <div class="col-md-4">
                    <div class="filter_col col-md-12" id="iname">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_name" data-name="name">Name</label>
                        <div class="lead_field" id="lead_name" data-name="name"> {% if lead_record.first_name  %}
                          {{ lead_record.first_name }}{% endif %} {% if lead_record.last_name  %}
                          {{ lead_record.last_name }}{% endif %}</div>
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_contact_account" data-name="name">Account Name</label>
                        {% if lead_record.account_name %}
                        <div class="lead_field" id="contact_account" data-name="name">{{ lead_record.account_name }}
                        </div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_title" data-name="name">Title</label>
                        {% if lead_record.title %}
                        <div class="lead_field" id="lead_title" data-name="name">{{ lead_record.title }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_phone" data-name="name">Phone</label>
                        {% if lead_record.phone %}
                        <div class="lead_field" id="lead_phone" data-name="name">{{ lead_record.phone }}</div>
                        {% else %}
                        <div class="lead_field">Not specified</div>
                        {% endif %}
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_email" data-name="name">Email</label>
                        {% if lead_record.email %}
                        <div class="lead_field" id="lead_email" data-name="name">{{ lead_record.email }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_status" data-name="name">Status</label>
                        {% if lead_record.status %}
                        <div class="lead_field" id="lead_status" data-name="name">{{ lead_record.status }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_source" data-name="name">Source</label>
                        {% if lead_record.source %}
                        <div class="lead_field" id="lead_source" data-name="name">{{ lead_record.source }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_website" data-name="name">Website</label>
                        {% if lead_record.website %}
                        <div class="lead_field" id="lead_website" data-name="name">{{ lead_record.website }}</div>
                        {% else %}
                        <div class="lead_field">Not Specified</div>
                        {% endif %}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">

                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        {% if lead_record.address_line or lead_record.street or lead_record.city or lead_record.state or lead_record.postcode or lead_record.country %}
                        <label class="lead_field_label" for="id_address" data-name="name">Billing Address</label>
                        <div class="lead_field" id="lead_address" data-name="name">
                          {{lead_record.get_complete_address}}
                        </div>
                        {% endif %}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    {% if lead_record.description %}
                    <div class="filter_col col-md-12">
                      <div class="form-group">
                        <label class="lead_field_label" for="id_description" data-name="name">Description</label>
                        <div class="lead_field" id="lead_description" data-name="name">{{ lead_record.description }}
                        </div>
                      </div>
                    </div>
                    {% endif %}
                    <div class="created_information">
                      Created by <b>{{ lead_record.created_by }}</b> created on <b
                        title="{{ lead_record.created_on }}">{{ lead_record.created_on_arrow }}</b>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    <div class="overview_form_block row marl justify-content-center" id="loading_spinner"
      style="z-index: 10; left: 0; right: 0; vertical-align: middle; position: absolute; margin-top: 15%;">

      <div class="spinner-border text-primary" style="width: 5em; height: 5em;" role="status">
        <span class="sr-only">Processing File...</span>
      </div>
    </div>
  </div>
</div>

{% endfor %}

<div class="modal fade" id="uploadleadfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Leads CSV File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="filter_col col-md-12">
            <div class="form-group">
              <label>Leads File <span class="error">{% if contact_list %}{% else %}*{% endif %}</span>
              </label>
              <input type="file" class="form-control" name="leads_file" accept=".csv" id="leads_file_input">
              <span id="id_leads_file"></span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row marl buttons_row text-center form_btn_row">
              <button type="submit" class="btn btn-default save">Save</button>
              <button type="button" class="btn btn-default clear" data-dismiss="modal"
                id="close_upload_form">Cancel</button>
              <!-- <a href="{{request.get_full_path}}" class="btn btn-default clear">Cancel</a> -->
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer text-center">
        <div class="text-center">
          <a href="{% url 'leads:sample_lead_file' %}">Download Sample File</a>
        </div>
      </div>
    </div>
    <div class="overview_form_block row marl justify-content-center" id="loading_spinner"
      style="z-index: 1000; left: 0; right: 0; vertical-align: middle; position: absolute; margin-top: -16%;">
      <div class="spinner-border text-primary" style="width: 3em; height: 3em;" role="status" id="spinner_body">
        <span class="sr-only">Processing File...</span>
      </div>
    </div>
  </div>
</div>


{% endblock %}
{% block js_block %}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
<script src="{% static 'js/ajaxForm.js' %}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('.assigned_users').select2();
    $('#id_tag').select2();
    $('#loading_spinner').hide()
    $('#spinner_body').hide()
    $('#tags_1').tagsInput({ width: 'auto' });
    $('.tags_1').tagsInput({ width: 'auto' });
    $(".filter_toggle").click(function () {
      $(".list_filter_row").toggle();
    });
    $('.remove_tag').hide()
  });

  $("#uploadleadfile").on("hidden.bs.modal", function () {
    // put your default event here
    $('#loading_spinner').hide()
    $('#spinner_body').hide()
    $('p.failure').remove();
    $('#leads_file_input').val('');
  });

  $(".tag_class_lead_").hover(
    function () {
      $('.remove_tag').hide()
      $(this).find(".remove_tag").show();
    },
    function () {
      $(this).find('.remove_tag').hide();
    });

  $(".tag_class_lead").click(function () {
    // $(".tag_class_opp").css('cursor', 'pointer')
    url = "{% url 'leads:list' %}"
    url = url + "?tag=" + $(this).attr('data-link')
    window.location.href = url;
  });

  $(".remove_tag").click(function () {
    // $(".tag_class_opp").css('cursor', 'pointer')
    url = "{% url 'leads:list' %}"
    console.log($(this).attr('data-tag'))
    console.log($(this).attr('data-lead'))
    const data = { 'tag': $(this).attr('data-tag'), 'lead': $(this).attr('data-lead') }
    const tagToRemove = $(this).attr('data-lead') + $(this).attr('data-tag')
    const lead = $(this).attr('data-lead')
    $.ajax({
      url: "{% url 'leads:remove_lead_tag' %}",
      type: "POST",
      data: data,
      beforeSend: function () {
        // $('#loading_spinner').show()
        // $('#opacity_block').addClass('opacity_block')
      },
      success: function (data) {
        if (data.error) {
          alert(data.error)
        } else {
          // TODO remove the tag based on attributes
          $('[data-leadTag="' + tagToRemove + '"]').remove()
          if ($(('#leadtag' + lead) + '> span').length < 1) {
            $('#leadtag' + lead).html('No Tags')
          }
          setTimeout(() => {
            alert("Tag Removed")
          }, 100);
        }
      }
    })


    // url = url + "?tag=" + $(this).attr('data-link')
    // window.location.href = url;
  });

  search = "{{search}}"

  $('#uploadleadfile').ajaxForm({
    type: 'POST',
    dataType: 'json',
    url: "{% url 'leads:upload_lead_csv_file' %}",
    data: $(this).serialize(),
    beforeSend: function () {
      $('#loading_spinner').show()
      $('#spinner_body').show()
      $('#cover_screen').addClass('add_opacity')
    },
    success: function (data) {
      if (data.error == false) {
        $('#close_upload_form').click()
        window.location.reload()
      } else {
        /*$(document).ajaxStop($.unblockUI);*/
        // $.unblockUI();
        $('p.failure').remove();
        for (var key in data.errors) {
          $('#id_' + key).html('<p class="error failure"> *' + data.errors[key] + '</p>');
          $('#loading_spinner').hide()
          $('#spinner_body').hide()
          $('#cover_screen').removeClass('add_opacity')

        }
      }
    },
    error: function (xhr, errmsg, err) {
      console.log('error data', errmsg, err)
    }
  });

  if (search == 'True') {
    $(".list_filter_row").show();
  }

  $("#close-tab").click(function (e) {
    $("#tab_status").val('Closed')
  })

  $("#open-tab").click(function (e) {
    $("#tab_status").val('Open')
  })

  tab_status = "{{tab_status}}"
  if (tab_status == 'Closed') {
    $("#close-tab").click()
  } else {
    $("#open-tab").click()
  }

  $('.delete').click(function (e) {
    e.preventDefault()
    url = $(this).attr('href')
    if (!confirm('Are you sure you want to delete?'))
      return;
    window.location = $(this).attr('href')
  });

  $("a[rel='page']").click(function (e) {
    e.preventDefault();
    $('#leads_filter').attr("action", $(this).attr("href"));
    $('#leads_filter').submit();
  });
</script>
{% endblock js_block %}