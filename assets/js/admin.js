
var kaffee = {
  
  KeyCodes: {
    ARROW_UP: 38,
    ARROW_DOWN: 40,
    BACKSPACE: 8,
    'DELETE': 46,
    ENTER: 13,
    ESCAPE: 27,
    PAGE_DOWN: 34,
    PAGE_UP: 33,
    SHIFT: 16,
    SPACE: 32,
    TAB: 9
  }
  
};

var App = (function() {
  
  var bodyClasses = $('body').attr('class').split(' ');
  
  return {
    
    isSection: function(section) {
      for(var i=bodyClasses.length; i--; ) {
        if(section === bodyClasses[i]) {
          return true;
        }
      }
      return false;
    }
    
  };
  
})();

$('select:not([multiple])').each(function(index, item) {
  new Skii.SelectInput(item);
});

if(App.isSection('form_view')) {
  
  $('a.cancel-button').bind('click', function(e) {
    e.preventDefault();
    if(confirm("Voulez-vous vraiment quitter la page?\nLes informations entrées seront perdues.")) {
      window.location = $(e.currentTarget).attr('href');
    }
  });
  
  $('div.multiple-select').each(function(index, item) {
    
    var $this = $(item),
    
    $choicesSelect = $this.find('label.left select'),
    $valuesSelect = $this.find('label.right select');
    
    $this.find('span.button-add').bind('click', function(e) {
    
      var $selectedOption = $choicesSelect.find('option:eq(' + $choicesSelect.get(0).selectedIndex + ')');
      
      $valuesSelect.append($selectedOption.clone());
      
      $selectedOption.remove();
    });
    
    $this.find('span.button-remove').bind('click', function(e) {
    
      var $selectedOption = $valuesSelect.find('option:eq(' + $valuesSelect.get(0).selectedIndex + ')');
      
      $choicesSelect.append($selectedOption.clone());
      
      $selectedOption.remove();
    });
    
    $this.closest('form').bind('submit', function() {
      $valuesSelect.find('option').attr('selected', 'selected');
    });
    
  });
  
}

if(App.isSection('list_view')) {
  
  var ListView = function() {
    
    var _this = this,
      doc = $(document);
    
    this.$table = $('#page-content').find('table');
    this.$rows = this.$table.find('tr:not(.table-header)');
    
    this.controller = this.$table.attr('data-controller');
    
    this.$table.delegate('tr:not(.table-header)', 'dblclick', $.proxy(this, 'editRow'));
    this.$table.delegate('tr:not(.table-header)', 'click', $.proxy(this, 'selectRows'));
    
    doc.bind('click', $.proxy(this, 'manageClickOutside'));
    
    this.$toolbarDelete = $('#toolbar-button-delete');
    this.$toolbarDelete.bind('click', $.proxy(this, 'deleteRows'));
    
    doc.bind('keydown', function(e) {
      if(e.which == kaffee.KeyCodes.DELETE || e.which == kaffee.KeyCodes.BACKSPACE) {
        _this.deleteRows(e);
      }
    });
    
    this.$lastSelectedRowIndex;
    
  };
  
  ListView.prototype = {
    editRow: function(e) {
      window.location = BASEURL + 'admin/' + this.controller + '/edit/' + $(e.currentTarget).attr('data-id');
    },
    selectRows: function(e) {
      var $this = $(e.currentTarget);
      
      if(!e.metaKey && !e.ctrlKey && !e.shiftKey) {
        this.unselectRows();
        $this.addClass('selected');
      }
      
      if(e.shiftKey) {
        
        if(typeof this.lastSelectedRowIndex != 'undefined') {
          var currentIndex = this.$rows.index(e.currentTarget),
            direction, i, l;
          
            if(currentIndex >= this.lastSelectedRowIndex) {
              direction = -1;
              i = currentIndex + 1;
              l = this.lastSelectedRowIndex;
            } else {
              direction = 1;
              i = currentIndex + 1;
              l = this.lastSelectedRowIndex + 1;
            }
          
          while(i != l) {
            this.$table.find('tr:eq(' + i + ')').addClass('selected');
            i = i + direction;
          }
        } else {
          $this.addClass('selected');
        }
        
      } else if((e.metaKey || e.ctrlKey) && $this.hasClass('selected')) {
        
        $this.removeClass('selected');
        
      } else {
        $this.addClass('selected');
      }
      
      this.lastSelectedRowIndex = this.$rows.index(e.currentTarget);
    },
    manageClickOutside: function(e) {
      if(this.$table.has(e.target).length === 0 && this.$table.get(0) != e.target) {
        this.unselectRows();
      }
    },
    unselectRows: function() {
      this.$table.find('tr.selected').removeClass('selected');
    },
    deleteRows: function(e) {
      e.preventDefault();
      var $toDelete = this.$table.find('tr.selected'),
        toDeleteLength = $toDelete.length;
      
      if(toDeleteLength) {
        if(confirm("Voulez-vous vraiment supprimmer les items sélectionnés?")) {
          
          var deleteIds = [];
          
          for(var i=0, l=toDeleteLength; i<l; i++) {
            deleteIds.push($($toDelete[i]).attr('data-id'));
          }
          
          $.post(BASEURL + 'admin/' + this.controller + '/delete', {id: deleteIds}, function() {
            $toDelete.remove();
            alert(toDeleteLength + ' items supprimés.');
          });
        }
      }
    }
  };
  
  new ListView();
}