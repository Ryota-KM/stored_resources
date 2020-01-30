import { select, call, takeLatest, put } from "redux-saga/effects";
import { selectStructure } from "../selectors/mainSelector";
import { mainActions } from "../actions";
import common from "../utils/common";

function doAsync(params) {
  const pathto = "/api/main.php";
  return common.callFetch(params, pathto);
}

function* fetchMakeDirectory(props) {
  let params = props.payload;
  const isCorrectName = common.validateFileFormat(params.name);
  if (isCorrectName) {
    params.actionType = "makedir";
    yield call(doAsync, params);
    let structure = yield select(selectStructure);
    const hierarchy = common.getHierarchy(params.path);
    let column = structure.get(hierarchy);
    column.push(params.name);
    structure.set(hierarchy, column);
    yield put(mainActions.continuousInputMkdirForm());
    yield put(mainActions.redrawStructure(structure));
  }
}
export default takeLatest("MAKE_DIRECTORY", fetchMakeDirectory);