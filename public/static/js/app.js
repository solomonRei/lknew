class TabsAutomatic {
  constructor(groupNode) {
    this.tablistNode = groupNode;
    this.tabs = [];
    this.firstTab = null;
    this.lastTab = null;
    this.tabs = Array.from(this.tablistNode.querySelectorAll("[role=tab]"));
    this.tabpanels = [];
    for (var i = 0; i < this.tabs.length; i += 1) {
      var tab = this.tabs[i];
      var tabpanel = document.getElementById(tab.getAttribute("aria-controls"));
      tab.tabIndex = -1;
      tab.setAttribute("aria-selected", "false");
      this.tabpanels.push(tabpanel);
      tab.addEventListener("keydown", this.onKeydown.bind(this));
      tab.addEventListener("click", this.onClick.bind(this));
      if (!this.firstTab) {
        this.firstTab = tab;
      }
      this.lastTab = tab;
    }
    this.setSelectedTab(this.firstTab, false);
  }
  setSelectedTab(currentTab, setFocus) {
    if (typeof setFocus !== "boolean") {
      setFocus = true;
    }
    for (var i = 0; i < this.tabs.length; i += 1) {
      var tab = this.tabs[i];
      if (currentTab === tab) {
        tab.setAttribute("aria-selected", "true");
        tab.removeAttribute("tabindex");
        this.tabpanels[i].hidden = false;
        if (setFocus) {
          tab.focus();
        }
      } else {
        tab.setAttribute("aria-selected", "false");
        tab.tabIndex = -1;
        this.tabpanels[i].hidden = true;
      }
    }
  }
  setSelectedToPreviousTab(currentTab) {
    var index;
    if (currentTab === this.firstTab) {
      this.setSelectedTab(this.lastTab);
    } else {
      index = this.tabs.indexOf(currentTab);
      this.setSelectedTab(this.tabs[index - 1]);
    }
  }
  setSelectedToNextTab(currentTab) {
    var index;
    if (currentTab === this.lastTab) {
      this.setSelectedTab(this.firstTab);
    } else {
      index = this.tabs.indexOf(currentTab);
      this.setSelectedTab(this.tabs[index + 1]);
    }
  }
  onKeydown(event) {
    var tgt = event.currentTarget, flag = false;
    switch (event.key) {
      case "ArrowLeft":
        this.setSelectedToPreviousTab(tgt);
        flag = true;
        break;
      case "ArrowRight":
        this.setSelectedToNextTab(tgt);
        flag = true;
        break;
      case "Home":
        this.setSelectedTab(this.firstTab);
        flag = true;
        break;
      case "End":
        this.setSelectedTab(this.lastTab);
        flag = true;
        break;
    }
    if (flag) {
      event.stopPropagation();
      event.preventDefault();
    }
  }
  onClick(event) {
    this.setSelectedTab(event.currentTarget);
  }
}
window.addEventListener("load", function() {
  var tablists = document.querySelectorAll("[role=tablist]");
  for (var i = 0; i < tablists.length; i++) {
    new TabsAutomatic(tablists[i]);
  }
});
