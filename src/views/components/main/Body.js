import React from "react";
import Column from "./Column";
import UploadField from "./fields/UploadField";
import PreviewField from "./fields/PreviewField";
import RemoveField from "./fields/RemoveField";
import MkdirModal from "../modals/MkdirModal";

class BodyComponent extends React.Component {
  constructor(props) {
    super(props);
    this.renderField = this.renderField.bind(this);
    this.renderColumns = this.renderColumns.bind(this);
  }

  renderField(fieldState) {
    if (fieldState.isview === true) {
      return <PreviewField text={fieldState.content} />;
    } else if (fieldState.isremove === true) {
      return <RemoveField />;
    } else {
      return <UploadField />;
    }
  }

  renderColumns(props) {
    const { structureState, actions } = props;
    if (structureState.structure.size > 0) {
      const items = structureState.workdir.split("/");
      const size = structureState.structure.size;
      const sizes = [...Array(size).keys()];
      const result = sizes.map(index => {
        return (
          <Column
            structureState={structureState}
            index={index}
            actions={actions}
            highLight={items[index] || ""}
          >
            {this.props.children}
          </Column>
        );
      });
      return result;
    }
  }

  render() {
    const { structureState, fieldState, modalFormState, actions } = this.props;
    return (
      <div className="container">
        {this.renderColumns(this.props)}
        <div id="display">
          <div id="toggles">{this.renderField(fieldState)}</div>
        </div>
        <MkdirModal
          structureState={structureState}
          fieldState={fieldState}
          modalFormState={modalFormState}
          actions={actions}
        />
      </div>
    );
  }
}

export default BodyComponent;
