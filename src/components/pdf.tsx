import { PDFObject } from 'react-pdfobject'

const Pdf = ({url, id}: { url: string, id?: string }): JSX.Element => {
  return (
    <PDFObject
      containerId={id}
      width="100%"
      height="600px"
      url={url}
      pdfOpenParams={{
        zoom: 'scale',
        pagemode: 'none',
        view: 'Fit',
      }}
    />
  )
}

export default Pdf
