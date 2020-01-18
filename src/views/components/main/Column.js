import React from "react";
import Row from "./Row";

const ColumnComponent = ({ ...props }) => {
  const { behaviorState, actions } = props;
  return (
    <div id="column">
      <div className="level">
        <div className="row" data-hierarchy="0">
          <img src="/assets/img/add.svg" className="open enable" />
          <img src="/assets/img/close.svg" className="close" />
        </div>
        <div className="row createNewDirRow">
          <input className="textbox" type="text" />
        </div>
        <Row behaviorState={behaviorState} actions={actions} />
      </div>
    </div>
  );
};

export default ColumnComponent;
