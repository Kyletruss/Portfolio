// import { MouseEvent } from "react";
import styles from './ListGroup.module.css'
import { useState } from "react";
import styled from 'styled-components';



const EndButton = styled.button`
  background-color: red;
  border: 1px solid red;
  width: 50px;
`;

interface Props {
    items: string[];
    heading: string;
    onSelectItem: (item: string) => void;
} 


function ListGroup({items, heading, onSelectItem}: Props) {


// arr[0] variable
// arr[1] update function
  const [selectedIndex, setSelectedIndex] = useState(-1)


//   const handleClick = (event: MouseEvent) => console.log(event)

  return (
    <>
      <h1>{heading}</h1>
      {/* basically if true, return the element, if false return false */}
      {items.length === 0 && <p>No item found</p>}
      <ul className="list-group">
        {items.map((item, index) => (
          <li
            className={selectedIndex === index ? "list-group-item active " + styles.asdf : "list-group-item"}
            key={item}
            onClick={() => {
                setSelectedIndex(index);
                onSelectItem(item);
            }}
          >
            {item}
          </li>
        ))}
        <EndButton className="btn btn-primary">test</EndButton>
      </ul>
    </>
  );
}

export default ListGroup;
